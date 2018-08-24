<?php

$login_id = isset($_POST['login_id']) === true ? $_POST["login_id"] : '';
$password = isset( $_POST['password']) === true ? $_POST["password"] : '';

$err_auth = '';
$err_login_id = '';
$err_password = '';

$mode = isset($_POST["mode"]) === true ? $_POST["mode"] : '';

switch ($mode) {
    case 'login':
        if (strlen($login_id) <= 0) $err_login_id ="ログインIDが入力されていません";
        if (strlen($password ) <= 0) $err_password ="パスワードが入力されていません";

        if ($err_login_id === '' && $err_password === '') {
            $fp = fopen( "password.csv","r");
            $data = fgetcsv($fp);
            //ログインIDとパス
            if ($login_id === $data[0] && $password === $data[1]) {
                echo "OK!ログインに成功しました。";
                exit;
            } else {
                $err_auth="ログイン情報が間違っています。";
            }
        }
        break;
    default:
        break;
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム</title>
</head>
<body>
<form method="post" action="" >
    ログイン:
    <input type="text" name="login_id" value="<?=$login_id?>" />
    <?=$err_login_id?><br>
    パスワード:
    <input type="password" name="password"  value="<?=$password?>" />
    <?=$err_password?><br>
    <?=$err_auth?><br>
    <input type="hidden" name="mode"  value="login" />
    <input type="submit" name="send"  value="送信" />
</form>
</body>
</html>