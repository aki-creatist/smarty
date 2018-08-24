<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>hiddenタグ</title>
</head>
<body> 
確認画面
<form name="form1" method="post" action="hidden.php">
    送信してもよろしいですか？
    <input type="submit" value="確　認">
    <input type="hidden" name="name" value="<?=$_POST["name"]?>">
    <input type="hidden" name="user_id" value="<?=$_POST["user_id"]?>">
</form>
</body>
</html>