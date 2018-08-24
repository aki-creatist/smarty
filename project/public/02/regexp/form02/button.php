<html>
<head>
    <title>PHPのテスト</title>
</head>
<body>
<?php
if (isset($_POST["confirm"])) { // 確認ボタンが押されたとき
    var_dump($_POST);
} elseif (isset($_POST["back"])) { // 戻るボタンが押されたとき
?>
    <h1>テキスト送信のテスト</h1>
    <form name="form1" method="post" action="confirm2.php">
        名前：<br>
        <input type="text" name="name" value="<?=$_POST["name"]?>">
        <input type="submit" value="送　信">
        <input type="hidden" name="user_id" value="<?=$_POST["user_id"]?>">
    </form>
<?php } else { // 上記条件以外のとき ?>
    エラーです。<br>
    <a href="button.html">button.html</a>からアクセスしてください。
<?php } ?>
</body>
</html>