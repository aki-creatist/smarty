<?php

// login
define( 'LOGIN_DB_HOST' ,'mysql');
define( 'LOGIN_DB_USER' ,'user');
define( 'LOGIN_DB_PASS' ,'pass');
define( 'LOGIN_DB_NAME' ,'project');
define( 'LOGIN_DB_TYPE' ,'mysql');

require_once '../../config.php';
require_once './class/PDODatabase.class.php';
require_once './class/Auth.class.php';
require_once './class/Session.class.php';

$location = "Location: http://localhost/shopping/list.php";

$login_id = isset($_POST["login_id"]) === true ? $_POST["login_id"] : "";
$password = isset($_POST["password"]) === true ? $_POST["password"] : "";

$err_auth = "";
$err_login_id = "";
$err_password = "";

if (isset($_POST["send"]) === true) {

    if ( strlen($login_id) <= 0) $err_login_id ="ログインIDが入力されていません";
    if ( strlen($password) <= 0) $err_password ="パスワードが入力されていません";

    if ($err_login_id === "" && $err_password === "") {
        $db = new Database(LOGIN_DB_HOST, LOGIN_DB_USER, LOGIN_DB_PASS, LOGIN_DB_NAME, LOGIN_DB_TYPE);
        $auth = new Auth($db);
        //ログインIDとパス
        if ($auth->isAccount($login_id, $password) === true) {

            $ses = new Session($db);
            $ses->setLoginId($login_id);
            header($location);
            exit;
        } else {
            $err_auth="ログインIDまたはパスワードが間違っています。";
        }
    }
}
?>
<html>
      <head>
           <meta http-equiv= "content-type" content= "text/html; charset = UTF-8"/>
     <title>ログインフォーム</title>
     </head>
     <body>
          <form method="post" action="" >  
          ログイン:
          <input type="text" name="login_id" value="<?php echo $login_id; ?>" />
          <br><?php echo $err_login_id; ?><br>
          パスワード:                                 
          <input type="password" name="password"  value="<?php echo $password; ?>" />
          <br><?php echo $err_password; ?><br>
          <?php echo $err_auth; ?><br>
          <input type="submit" name="send"  value="送信" />
        </form>
   </body>
</html>
