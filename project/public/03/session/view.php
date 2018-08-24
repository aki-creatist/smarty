<?php
session_start();
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Session</title>
<body>

<?php if (isset($_POST["confirm"])) { // 確認ボタンが押されたとき ?>

    <?=$_SESSION["name"]?> さんからのメッセージ<br>
    本文：<?=nl2br($_SESSION["contents"])?><br>

    <a href="form.html">もう一度試すにはここをクリック</a>

    <hr>
    <pre><?=print_r($_SESSION)?></pre>
    <hr>

<?php } elseif (isset($_POST["back"])) { // 戻るボタンが押されたとき ?>

    <h3>テキスト送信のテスト</h3>
    <form name="form1" method="post" action="confirm.php">
        名前：<br>
        <input type="text" name="name" value="<?=$_SESSION["name"]?>"><br>
        
        本文：<br>
        <textarea name="contents" cols="30" rows="5"><?=$_SESSION["contents"]?></textarea><br>

        <input type="submit" value="送　信">
    </form>

<?php } else { // 上記条件以外のとき ?>

    エラーです。<br>
    <a href="form.html">form.html</a>からアクセスしてください。

<?php } ?>

</body>
</html>
