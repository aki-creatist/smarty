<?php
require_once '../../config.php';
require_once '../../php_libs/model/base/BaseModel.php';
require_once './class/PDODatabase.class.php';
require_once './class/Session.class.php';
require_once './class/Cart.class.php';

$db     = new Database();
$ses    = new Session($db);
$cart   = new Cart($db);

// テンプレート指定
require_once  '../../php_libs/vendor/autoload.php';
$smarty = new Smarty();
$smarty->setTemplateDir('../../php_libs/view/shopping')
    ->setCompileDir('../../php_libs/templates_c');

// セッションに、セッションIDを設定する
$ses->checkSession();
$customer_no = $_SESSION['customer_no']; // 誰が購入したか

// item_idを取得する
$item_id = (isset($_GET['item_id']) === true && preg_match('/^[0-9]+$/', $_GET['item_id']) === 1) ? $_GET['item_id'] : '';

// 削除用のcrt_idを取得する
$crt_id = (isset($_GET['crt_id']) === true && preg_match('/^\d+$/', $_GET['crt_id']) === 1 ) ? $_GET['crt_id'] : '';

if ($item_id !== '') {
    $res = $cart->insCartData($customer_no, $item_id);
    if ($res !== false) {
        echo "商品をカートに入れました";
    } else {
        echo "商品がカートに入りませんでした";
    }
}

if ($crt_id !== '') {
    $cart->delCartData($crt_id);
}

list($num, $price) = $cart->getItemAndSumPrice($customer_no);

// カート情報を取得する
$data = $cart->getCartData($customer_no);

$smarty->assign('data',  $data);
$smarty->assign('sumNum',   $num);
$smarty->assign('sumPrice', $price);
$smarty->display('cart.tpl');
