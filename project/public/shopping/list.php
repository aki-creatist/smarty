<?php
require_once '../../config.php';
require_once '../../php_libs/model/base/BaseModel.php';
require_once './class/PDODatabase.class.php';
require_once './class/CheckError.class.php';
require_once './class/Session.class.php';

$db   = new Database();
$ses    = new Session($db);
$checkError = new CheckError();

// テンプレート指定
require_once  '../../php_libs/vendor/autoload.php';
$smarty = new Smarty();
$smarty->setTemplateDir('../../php_libs/view/shopping')
    ->setCompileDir('../../php_libs/templates_c');

//選択肢リスト
$item_name = isset($_POST['item_name']) === true ? $_POST['item_name'] : '';
$price     = isset($_POST['price']) === true ? $_POST['price'] : '';

$file_name = "none";

$arr_err_msg = [
    "name"  => '',
    "price" => '',
    "image" => ''
];

$arr_form = [
    "name"  => $item_name,
    "price" => $price
];

if (isset($_POST['send']) === true && $_POST['send'] === '送信') {
    $arr_err_msg = $checkError->errorCheck($arr_form, $_FILES);
    $check_flg = $checkError->getErrorFlg();

    if ($check_flg === true) {
        $file_name = $_FILES["image"]["error"] !== 4 ? $item_name . ".jpg" : 'none';

        $ins_data = [
            'name'  => $item_name,
            'price' => $price,
            'image' => $file_name
        ];
        $res = $db->insert('items', $ins_data);

        if ($res !== false) {
            //ファイルUP
            if ($file_name !== 'none') {
                if (move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $file_name) === true) {
                    echo "success!"; exit;
                }
            } else {
                echo "success!"; exit;
            }
        } else {
            echo "データ入力に失敗しました。"; exit;
        }
    }
}

$login_id = $ses->getLoginId();
//sessionkeyをみて、DBへの登録状態をチェックする
$ses->checkSession();

// $category_idを取得する
$category_id = (isset($_GET['category_id']) === true && preg_match('/^[0-9]+$/', $_GET['category_id']) === 1) ? $_GET['category_id'] : '';
// 検索条件があればセットする
$where = $category_id !== '' ? 'category_id=' . $category_id : '';

if (isset($_POST['send']) === true && $_POST['send'] === '検索') {
    $search_word = $_POST["search_word"];
} else {
    $search_word = '';
}

if ($search_word !== "") {
    $where  = ' name like ? ';
    $real_value =  ["%" . $search_word . "%"]; // ?に結びつける実際の値
} else {
    $where  = $category_id !== '' ? ' category_id = ? ' : '';
    $real_value = $category_id !== '' ? [$category_id] : [];
}
$data = $db->select('items', 'id, name, price, image', $where, $real_value);

$categories = $db->select('categories', 'id, name');
$smarty->assign("search_word",$search_word);
$smarty->assign('arr_form', $arr_form);
$smarty->assign('arr_err_msg', $arr_err_msg);
$smarty->assign("login_id", $login_id);
$smarty->assign("categories", $categories);
$smarty->assign("data", $data);
$smarty->display('list.tpl');
