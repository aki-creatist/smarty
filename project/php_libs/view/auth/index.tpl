<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>ログイン</title>
</head>

<body>
    <form method="post" action="" >
    ログイン:
    <input type="text" name="login_id" value="{$login_id}" />
    <br>{$err_login_id}<br>
    パスワード:
    <input type="password" name="password"  value="{$password}" />
    <br>{$err_password}<br>
    {$err_auth}<br>
    <input type="submit" name="send"  value="送信" />
  </form>
  {$message}
</body>
</html>
