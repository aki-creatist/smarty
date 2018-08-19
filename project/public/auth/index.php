<?php
require_once '../../config.php';
//require_once './Database.class.php';
require_once '../../php_libs/model/base/BaseModel.php';
require_once '../../php_libs/model/base/Database.php';

require_once './Auth.class.php';
require_once  '../../php_libs/vendor/autoload.php';

ini_set('date.timezone', 'Asia/Tokyo');

$smarty = new Smarty();
$smarty->setTemplateDir('../../php_libs/view/auth')
    ->setCompileDir('../../php_libs/templates_c');

$login_id = isset($_POST["login_id"]) === true ? $_POST["login_id"] : "";
$password = isset($_POST["password"]) === true ? $_POST["password"] : "";

$err_auth = "";
$err_login_id = "";
$err_password = "";

if (isset($_POST["send"]) === true) {

    if (strlen($login_id) <= 0) $err_login_id ="ログインIDが入力されていません";
    if (strlen($password) <= 0) $err_password ="パスワードが入力されていません";
    
    if ($err_login_id === "" && $err_password === "") {

        $db = new Database();
        $auth = new Auth($db);

        //ログインIDとパス
        if ($auth->isAccount($login_id, $password) !== false) {
            echo "ログインできました。";exit;
        } else {
            $err_auth = "ログインIDまたはパスワードが間違っています。";
        }
    }
}

$smarty->assign('login_id', $login_id);
$smarty->assign('password', $password);
$smarty->assign('err_login_id', $err_login_id);
$smarty->assign('err_password', $err_password);
$smarty->assign('err_auth', $err_auth);
$smarty->display('index.tpl');
