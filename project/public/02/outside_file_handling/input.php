<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>外部ファイル操作</title>
</head>
<body>
<h3>書き込み</h3>
<form method="POST" action="write.php">
    <div id="container">
        <label for="name">お名前：</label>
        <input type="text" id="name" name="name"
               size="20" maxlength="30" />
    </div>
    <div id="container">
        <label for="message">メッセージ：</label>
        <input type="text" id="message" name="message"
               size="70" maxlength="255" />
    </div>
    <input type="submit" value="送信" />
</form>
</body>
</html>