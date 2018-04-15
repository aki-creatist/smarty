<?php

class MembersController extends BaseController
{
    use FormTrait;
    public $mode;
    public $next_mode;
    public $action;
    public function __construct($flg = false)
    {
        $this->viewInitialize('members');
        $this->database = new Members();
        $this->validator = new Validator();
        $this->auth = new AuthController();
        $this->sess = new SessionController();
        $this->traffic = new Traffic();
        $this->preMember = new PreMember();

        $this->MemberPostcode = new MemberPostcode();
        $this->MemberTraffic = new MemberTraffic();

        $this->is_system = $flg;
        if ($this->is_system) {
            $this->auth->setAuthName(_SYSTEM_AUTHINFO);
            $this->sess->setSessName(_SYSTEM_SESSNAME);
        } else {
            $this->auth->setAuthName(_MEMBER_AUTHINFO);
            $this->sess->setSessName(_MEMBER_SESSNAME);
        }
        $this->sess->start();

        if (isset($_REQUEST['mode'])) {
            $this->mode = $_REQUEST['mode'];
        }
        if (isset($_REQUEST['action'])) {
            $this->action = $_GET['action'];
        }
    }

    public function test()
    {
        $data = $this->database->selectTest();
        $this->view->assign('data', var_dump($data));
        $this->view->display('test.tpl');
    }

    public function login()
    {
        $this->view->assign('mode', 'authenticate');
        $this->view->assign('title', 'ログイン画面');
        $this->view->display('login.tpl');
    }

    public function authenticate()
    {
        $user = $this->auth->getUser($_POST['username']);
        if (!empty($user['password']) &&
            $this->auth->checkPW($_POST['password'], $user['password'])) {
            $this->auth->authOK($user);
            $this->top();
        } else {
            $this->auth_error_mess = $this->auth->authNG();
            $this->login();
        }
    }

    public function top()
    {
        if (!$this->auth->check()) {
            header("location: index.php?mode=login");
        }
        $last_name = $_SESSION[_MEMBER_AUTHINFO]['last_name'];
        $first_name = $_SESSION[_MEMBER_AUTHINFO]['first_name'];
        $this->view->assign('last_name', $last_name);
        $this->view->assign('first_name', $first_name);
        $this->view->assign('title', '会員トップ画面');
        $this->view->display('top.tpl');
    }

    public function create()
    {
        $this->makeForm();
        if ($this->action === 'form')     $this->form();
        if ($this->action === 'confirm')  $this->confirm();
        if ($this->action === 'complete') $this->complete();
    }

    public function update()
    {
        if (!$this->auth->check()) header("location: ./index.php?mode=login");
        $this->makeForm();
        if ($this->action === 'form')     $this->form();
        if ($this->action === 'confirm')  $this->confirm();
        if ($this->action === 'complete') $this->complete();
    }

    public function delete()
    {
        if ($this->action === 'confirm')  $this->confirm();
        if ($this->action === 'complete') $this->complete();
    }

    public function form()
    {
        if ($this->mode === "create")     $this->screenRegistForm();
        if ($this->mode === "update")     $this->screenUpdateForm();
    }

    public function confirm()
    {
        if ($this->mode === 'delete') $this->screenDeleteConfirm();
        if ($this->mode !== 'delete') {
//            unset($_POST['submit']);
//            unset($_POST['action']);
            $this->view->assign('err_msgs', $this->validator->check($_POST, 'members'));
            $error_flag = $this->validator->getErrorFlg();

            if (!$error_flag) $this->screenRegistForm();
            if ($error_flag) $this->screenRegistConfirm($_POST);
        }
    }

    public function complete()
    {
        $user = $_POST;
        $pass = $user['password'];
        $user['password'] = $this->auth->getHashedPW($pass);

        if ($this->mode === 'create') $this->screenCreateComplete($user);
        if ($this->mode === 'update') $this->screenUpdateComplete($user);
        if ($this->mode === 'delete') $this->screenDeleteComplete();
        // 管理者でない場合、アカウント削除後にログアウト
        if (!$this->is_system) $this->sess->logout();
    }

    // ログイン中の表示
    private function dispLoginState()
    {
        if (is_object($this->Auth) && $this->Auth->check()) {
            $this->login_state = ($this->is_system) ? '管理者ログイン中' : '会員ログイン中';
        }
    }

    /**
     * 新規登録フォームを表示
     */
    public function screenRegistForm()
    {
        if ($_POST !== []) $this->view->assign('posted_data', $_POST); // 送信された値を挿入
        $this->view->assign('title', $this->getRegistFormData()); // 登録画面 or 更新画面
        $this->view->assign('mode', $this->mode); // create or update
        $this->view->display('form.tpl');
    }

    /**
     * 現在のモード(URLにセットされた値)により、フォームのタイトル文言の判別
     */
    public function getRegistFormData()
    {
        if ($this->mode === "create") return '登録画面';
        if ($this->mode === "update") return '更新画面';
    }
    /**
     * 新規登録確認画面を表示
     */
    public function screenRegistConfirm($post)
    {
        $this->next_action = 'complete'; // 次のアクション
        $this->view->assign('posted_data', $post);
        $this->view->assign('title', $this->getRegistConfirmmData());
        $this->view->assign('mode', $this->mode);
        $this->view->assign('action', 'complete');
        $this->view->display('confirm.tpl');
    }
    /**
     * 現在のモード(URLにセットされた値)により、確認画面のタイトル文言の判別
     */
    public function getRegistConfirmmData()
    {
        if ($this->mode === "create") return '登録確認画面';
        if ($this->mode === "update") return '更新確認画面';
    }

    /**
     * 更新フォームを表示 - ユーザデータをあらかじめフォームに挿入
     */
    public function screenUpdateForm()
    {
        $user = $this->getUpdateFormData(); // DBのユーザデータを取得
//        var_dump($user);
        $this->view->assign('title', '更新画面');
        $this->view->assign('mode', 'update');
        $this->view->assign('posted_data', $user);
        $this->view->display('form.tpl');
    }
    /**
     * 更新フォームに事前に入れる値をDBから取得する
     */
    public function getUpdateFormData()
    {
        if ($this->is_system)  $id = $_GET['id'];
        if (!$this->is_system) $id = $_SESSION[$this->auth->getAuthName()]['id'];

        $user = $this->database->getDetail($id);
        return $this->mergeAddress($user); //DBのユーザデータに関連テーブルのデータを追加して返す
    }
    /**
     * 削除同意画面の表示
     */
    public function screenDeleteConfirm()
    {
        $this->view->assign('posted_data', $this->getDeleteConfirmData());
        $this->view->assign('title', '削除確認画面');
        $this->view->assign('message', $this->is_system ? '削除しますか？' : '退会しますか？');
        $this->view->assign('btn', $this->is_system ? '削除' : '退会');
        $this->view->assign('mode', 'delete');
        $this->view->display('confirm.tpl');
    }
    /**
     * 削除対象データの取得
     */
    public function getDeleteConfirmData()
    {
        if ($this->is_system) $_SESSION['id'] = $id = $_GET['id'];
        if (!$this->is_system) $id = $_SESSION[$this->auth->getAuthName()]['id'];

        $post = $this->database->getDetail($id);
        return $this->mergeAddress($post);
    }
    /**
     * 登録完了画面の表示
     */
    public function screenCreateComplete($user)
    {
        // 仮登録/即時登録 のいずれにも不要な値を外す
        unset($user['submit']);
        unset($user['mode']);
        unset($user['action']);
        // 一般会員の場合にはデータにハッシュを追加
        if (!$this->is_system) $user['link_pass'] = hash('sha256', uniqid(rand(),1));
        // データの挿入
        $this->createComplete($user);

        $this->view->assign('title', $this->is_system ? '登録完了画面' : '仮登録完了画面');
        $this->view->assign('message', $this->is_system ? '登録が完了しました' : $this->getCreateCompleteMessage($user));
        $this->view->display('message.tpl');
    }
    /**
     * データの登録 - 会員/管理者 で分岐
     */
    public function createComplete($user)
    {
        if ($this->is_system) $this->CreateCompleteBySystem($user);  // 管理者
        if (!$this->is_system) $this->CreateCompleteByMember($user); // 一般
    }
    /**
     * データの登録 - 会員
     */
    public function CreateCompleteByMember($user)
    {
        $this->preMember->createPreMember($user);
    }
    /**
     * データの登録 - 管理者
     */
    public function CreateCompleteBySystem($user)
    {
        $this->database->createMemberFromSystem($user);
//        $this->database->createUser($user);
//        $this->MemberPostcode->createMemberPostcode($user);
//        $this->MemberTraffic->createMemberTraffic($user);
    }
    /**
     * 登録完了メッセージを取得 - 一般ユーザの場合は仮登録リンクを生成する
     */
    public function getCreateCompleteMessage($user)
    {
        $message = "メール本文に記載されているURLにアクセスして登録を完了してください。<BR>";
        $link = "premember.php?username=" . $user['username'] . "&link_pass=". $user['link_pass'];
        $message .= "<a href=$link>リンク</a>";
        return $message;
    }
    /**
     * 更新完了画面の表示
     *
     */
    public function screenUpdateComplete($user)
    {
        $this->UpdateComplete($user);
        $this->view->assign('title', '更新完了');
        $this->view->display('message.tpl');
    }
    /**
     * 更新データの取得
     */
    public function UpdateComplete($user)
    {
        $id = $_SESSION[$this->auth->getAuthName()]['id'];
        $this->database->updateUser($id, $user);
        $this->MemberPostcode->updateMemberPostcode($id, $user);
        $this->MemberTraffic->updateMemberTraffic($id, $user);
    }
    /**
     * 削除完了画面の表示
     */
    public function screenDeleteComplete()
    {
        $this->deleteComplete(); // データの削除
        $this->view->assign('title', $this->is_system ? '削除完了画面' : '退会完了画面');
        $this->view->assign('message', $this->is_system ? '削除完了' : '退会完了');
        $this->view->display('message.tpl');
    }
    /**
     * 削除対象データの取得
     */
    public function deleteComplete()
    {
        if ($this->is_system)  $id = $_SESSION['id'];
        if (!$this->is_system) $id = $_SESSION[$this->auth->getAuthName()]['id'];

        $this->MemberPostcode->deleteMemberPostcode($id);
        $this->MemberTraffic->deleteMemberTraffic($id);
        $this->database->deleteUser($id);
    }
    /**
     * ユーザデータに対し、関連テーブルから取得した 郵便番号/住所/交通手段 を統合する
     */
    public function mergeAddress($user)
    {
        list(
            $user['zip1'],
            $user['zip2'],
            $user['address']
            ) = $this->MemberPostcode->getMemberPostcode($user['id']);
//        var_dump($user);
        $user['traffic'] = $this->MemberTraffic->getMemberTraffic($user['id']);

        return $user;
    }
    /**
     * フォームの作成
     */
    public function makeForm()
    {
        $this->view->assign('date', $this->getDate());
        $this->view->assign('genders', $this->getGenders());
        $this->view->assign('traffics', $this->getTraffic());
    }
    private function getTraffic()
    {
        return $this->traffic->getIndex();
    }
}