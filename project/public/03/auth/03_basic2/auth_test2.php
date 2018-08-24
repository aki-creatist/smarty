<?php
/*
 * ユーザー名とパスワードを受け取る
 */

if (empty($_SERVER['PHP_AUTH_USER']) || // ユーザーIDをチェック
    empty($_SERVER['PHP_AUTH_PW'])) {   // パスワードをチェック
    // realm属性はダブルクォーテーション(また必ずエスケープすること)
    header("WWW-Authenticate: Basic realm=\"Member Only\"");
    header("HTTP/1.0 401 Unauthorized");
} else {
	echo $_SERVER['PHP_AUTH_USER'] . "<br>"; // ユーザーIDを表示
	echo $_SERVER['PHP_AUTH_PW'];            // パスワードを表示
}
?>