<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <?php
    session_start();
    $count = 1;
    if (isset($_SESSION["count"])) {
        $count = $_SESSION["count"];
        $count++;
    }
    $_SESSION["count"] = $count;
    ?>
</head>
<body>

</body>
</html> 
<h4>セッション変数のテスト</h4>
 
<?php
if ($count == 1) {?>
    はじめての訪問です。<BR>
    セッション変数にデータがありません。<BR>
    このページをリロードしてください。<BR>
<?php } else { ?>
あなたの訪問は<?=$count?>回目です。<BR> 
<?php } ?>
