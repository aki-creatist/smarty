<?php
class PreMembersController extends BaseController
{
    public function __construct()
    {
        $this->viewInitialize('members');
        $this->PreMember = new PreMember();
    }
    public function run()
    {
        if (isset($_GET['username']) && isset($_GET['link_pass'])) {
            // 必要なパラメータがある
            $user = $this->PreMember->getPreMember($_GET['username'], $_GET['link_pass']);
            if (!empty($user) && count($user) >= 1) {
                // パラメータが合致する
                // 仮登録テーブルから削除して、memberへデータを挿入する
                $this->PreMember->deletePreAndRegist($user);
                $title = '登録完了画面';
                $message = '登録を完了しました。トップページよりログインしてください。';
            } else {
                // パラメータが合致しない
                $title = 'エラー画面';
                $message = 'このURLは無効です。';
            }
        } else {
            // 必要なパラメータがない
            $title = 'エラー画面';
            $message = 'このURLは無効です。';
        }
        $this->view->assign('title', $title);
        $this->view->assign('message', $message);
        $this->view->display('premember.tpl');
    }
}