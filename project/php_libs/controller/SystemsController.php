<?php

class SystemsController extends BaseController
{
    public $mode;
    public function __construct()
    {
        $this->viewInitialize('systems');
        $this->database = new Systems();
        $this->validator = new Validator();
        $this->auth = new AuthController();
        $this->sess = new SessionController();

        $this->MemberPostcode = new MemberPostcode();
        $this->MemberTraffic = new MemberTraffic();

        $this->auth->setAuthName(_SYSTEM_AUTHINFO);
        $this->sess->setSessName(_SYSTEM_SESSNAME);
        $this->sess->start();

        if (isset($_REQUEST['mode'])) {
            $this->mode = $_REQUEST['mode'];
        }
        if (isset($_REQUEST['action'])) {
            $this->action = $_REQUEST['action'];
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
        $user = $this->database->getAdmin($_POST['username']);
        if (!empty($user['password'])
            && $this->auth->checkPW($_POST['password'], $user['password'])) {
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
        $this->view->assign('title', 'トップ画面');
        $this->view->display('top.tpl');
    }


    public function index()
    {
        if (!$this->auth->check()) {
            header("location: ./index.php?mode=login");
        }
        $disp_search_key = "";
        $sql_search_key = "";
        // セッション変数の処理
        if (isset($_POST['search_key']) && $_POST['search_key'] !== "") {
            unset($_SESSION['pageID']);
            $_SESSION['search_key'] = $_POST['search_key'];
            $disp_search_key = htmlspecialchars($_POST['search_key'], ENT_QUOTES);
            $sql_search_key = $_POST['search_key'];
        } else {
            if (isset($_POST['submit']) && $_POST['submit'] == "検索する") {
                unset($_SESSION['search_key']);
            } else {
                if (isset($_SESSION['search_key'])) {
                    $disp_search_key = htmlspecialchars($_SESSION['search_key'], ENT_QUOTES);
                    $sql_search_key = $_SESSION['search_key'];
                }
            }
        }

        list($data, $count) = $this->database->getList($sql_search_key);

        list($data, $links) = $this->makePageLink($data);
        $this->view->assign('count', $count);
        $this->view->assign('data', $data);
        $this->view->assign('search_key', $disp_search_key);
        $this->view->assign('links', $links['all']);
        $this->title = '管理 - 会員一覧画面';
        $this->view->display('list.tpl');
    }

    public function detail()
    {
        if (!$this->auth->check()) {
            header("location: ./index.php?mode=login");
        }
        $id = $_GET['id'];

        $data = $this->database->getDetail($id);

        list(
            $data['zip1'],
            $data['zip2'],
            $data['address']
            ) = $this->MemberPostcode->getMemberPostcode($id);
        $data['traffic'] = $this->MemberTraffic->getMemberTraffics($id);
        $this->view->assign('posted_data', $data);
        $this->view->assign('title', '会員詳細画面');
        $this->view->display('detail.tpl');
    }
}