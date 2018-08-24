<?php
session_start();
$_SESSION["name"]  = $_POST["name"];
$_SESSION["contents"]  = $_POST["contents"];
if (isset($_POST["user_id"])) {
    $_SESSION["user_id"] = $_POST["user_id"];
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Session</title>
<body>

<h4>確認画面</h4>
<form name="form1" method="post" action="view.php">

    名前：<?=$_POST["name"]?><br>
    本文：<?=nl2br($_POST["contents"])?><br>

    <input type="submit" value="確　認" name="confirm">　
    <input type="submit" value="戻　る" name="back">
</form>

</BODY>
</HTML>
