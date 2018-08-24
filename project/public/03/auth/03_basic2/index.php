<?php
/*
 * Basic認証を実行
 */
if (empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])) {
    header("WWW-Authenticate: Basic realm=\"Member Only\"");
    header("HTTP/1.0 401 Unauthorized");
?>
<html>
<head>
<title>キャンセルされた際の表示</title>
<meta charset="UTF-8">
</head>
<body>
Basic認証のテスト<br>
<br>
キャンセルされました。

</body>
</html>

<?php
} else { // 保護された画面を表示
    if ($_SERVER['PHP_AUTH_USER'] == "sample" && // IDを判断
        $_SERVER['PHP_AUTH_PW'] == "password") { // パスワードを判断
?>
<html>
<head>
<title>保護された画面を表示</title>
<meta charset="UTF-8">
</head>
<body>
Basic認証のテスト<br><br>

こんにちは、<?=$_SERVER['PHP_AUTH_USER']?>さん。

</body>
</html>
<?php
    } else { // 認証失敗時
?>
<html>
<head>
<title>IDまたはPWを間違った際の表示</title>
<meta charset="UTF-8">
</head>
<body>
Basic認証のテスト<br><br>

ユーザID、またはパスワードが違います。

</body>
</html>

<?php
    }
}
?>
