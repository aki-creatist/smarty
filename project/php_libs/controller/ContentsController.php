<?php

class ContentsController extends BaseController
{
    public function __construct()
    {
        $this->viewInitialize('contents');
        $this->database = new Contents();
        $this->validator = new Validator();

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

    public function screenContents()
    {
        $action = isset($_POST['action']) ? $_POST['action'] : 'form';
        switch ($action) {
            case "form":
                $this->view->assign('title', '掲示板');
                $this->view->assign('btn', '書き込む');
                $this->index();
                break;
            case "regist":
                $this->screenRegist();
                break;
        }
    }

    public function screenRegist()
    {
        unset($_POST['submit']);
        $post = $_POST; //データを受け継ぐ
        $this->err_msgs = $this->validator->check($post, 'contents');
        $err_check = $this->validator->getErrorFlg();
        if ($err_check === true) { // エラーなし
            $this->screenComplete($post);
        } else {                    // エラーあり
            $this->view->assign('title', '掲示板');
            $this->view->assign('btn', '書き込む');
            $this->index();
        }
    }

    public function screenComplete($post)
    {
        unset($post['send']); // DB挿入に余計なデータを外す
        unset($post['action']);
        $this->database->insertData($post);
        $this->view->assign('title', '掲示板');
        $this->view->assign('btn', '書き込む');
        $this->index();
    }

    public function screenModify()
    {
        $id = $_GET['id'];
        $where = ' id=' . $id;
        if ($_POST === []) {
            $this->view->assign('posted_data', $this->database->first('contents', $where));
            $this->view->assign('btn', '更新する');
            $this->index();
        } else {
            unset($_POST['send']);
            unset($_POST['action']);

            $data = $_POST;
            $this->database->update('contents', $data, $where);
            $this->redirect();
            $this->index();
        }
    }

    public function redirect()
    {
        $url = $_SERVER["REQUEST_URI"];
        $url = (parse_url($url));
        header("Location: {$url['path']}");
    }

    public function screenDelete()
    {
        //削除画面を表示
    }

    public function index()
    {
        if (isset($_POST['search_key'])
            && $_POST['search_key'] !== '') {
            $sql_search_key = $this->search();
        }

        list($data, $count) = $this->database->getList($sql_search_key);
        list($data, $links) = $this->makePageLink($data);

        // viewに渡す
        $this->view->assign('data', $data);
        $this->view->assign('count', $count); // 全件
        $this->view->assign('links', $links['all']); // ページャリンク

        $this->view->display('index.tpl');
    }

    private function search()
    {
        $sql_search_key = $_POST['search_key'];
        $disp_search_key = $this->quote($sql_search_key);
        return $disp_search_key;
    }

    public function quote($val)
    {
        $val = htmlspecialchars($val, ENT_QUOTES);
        return $val;
    }
}
