<?php
$count = 1;
if (isset($_COOKIE["count"])) {
    $count = $_COOKIE["count"];
    $count++;
}
setcookie("count", $count, time() + 10 );
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    クッキーのテスト<br>
<?php if ($count == 1) { ?>
    はじめての訪問です。<br>
    <br>
    クッキー情報はありません。<br>
    このページをリロードしてください。<br>
<?php } else { ?>
    あなたの訪問は<?=$count?>回目です。<br>
    10秒以内にリロードするとカウントアップします。
<?php } ?>
</body>
</html>
