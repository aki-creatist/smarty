<?php

class BaseController
{
    /**
     * Smarty
     */
    public function viewInitialize($dir)
    {
        $this->view = new Smarty();
        // Smarty関連ディレクトリの設定
        $this->view->setTemplateDir(_SMARTY_TEMPLATES_DIR . $dir)
            ->setCompileDir(_SMARTY_TEMPLATES_C_DIR);
//        var_dump($_POST);
    }

    // フォームと変数を読み込んでテンプレートに組み込んで表示
    public function viewDisplay($file)
    {
        $this->view->display($file);
    }

    /**
     * ページ分割処理
     * @param $data
     * @return array
     */
    public function makePageLink($data)
    {
        // Slindingを使用する場合
        //require_once 'Pager/Sliding.php';
        // Pagerを使用する場合
        require_once 'Pager/Jumping.php';

        $params = [
            'mode'      => 'Jumping',
            'perPage'   => 5,
            'delta'     => 5,
            'itemData'  => $data
        ];
        // PHP5でSlindingを使用する場合
        // $pager = new Pager_Sliding($params);
        // PHP5でPagerを使用する場合
        $pager = new Pager_Jumping($params);

        $data  = $pager->getPageData();
        $links = $pager->getLinks();
        return [$data, $links];
    }

    // デバッグ用表示処理
    public function debugDisplay()
    {
        if (_DEBUG_MODE) {
            $this->debug_str = "";
            if (isset($_SESSION)) {
                $this->debug_str .= '<br><br>$_SESSION<br>';
                $this->debug_str .= var_export($_SESSION, TRUE);
            }
            if (isset($_POST)) {
                $this->debug_str .= '<br><br>$_POST<br>';
                $this->debug_str .= var_export($_POST, TRUE);
            }
            if (isset($_GET)) {
                $this->debug_str .= '<br><br>$_GET<br>';
                $this->debug_str .= var_export($_GET, TRUE);
            }
            // smartyのデバッグモード設定 ポップアップウィンドウにテンプレート内の変数を
            // 表示します。
            $this->view->debugging = _DEBUG_MODE;
        }
    }
}