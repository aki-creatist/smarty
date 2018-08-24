<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>buttonの分岐</title>
</head>
<body> 
確認画面
<form name="form1" method="post" action="button.php">
    送信してもよろしいですか？
    <input type="submit" name="confirm" value="確　認">
    <input type="submit" name="back" value="戻　る">
    <input type="hidden" name="name" value="<?=$_POST["name"]?>">
    <input type="hidden" name="user_id" value="<?=$_POST["user_id"]?>">
</form>
</body>
</html>