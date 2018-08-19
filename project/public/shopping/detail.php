<?php
require_once '../../config.php';
require_once '../../php_libs/model/base/BaseModel.php';
require_once './class/PDODatabase.class.php';

$db = new Database();

// テンプレート指定
require_once  '../../php_libs/vendor/autoload.php';
$smarty = new Smarty();
$smarty->setTemplateDir('../../php_libs/view/shopping')
    ->setCompileDir('../../php_libs/templates_c');

// item_idを取得する
$item_id = (isset($_GET['item_id']) === true && preg_match('/^[0-9]+$/', $_GET['item_id']) === 1) ? $_GET['item_id'] : '';

// item_idが取得できていない場合、商品一覧へ遷移させる
if ($item_id === '') header('Location: ./list.php');

$where = 'id=' . $item_id;
$data = $db->first('items', 'id, name, detail, price, image', $where);

$smarty->assign("data", $data);
$smarty->display('detail.tpl');
