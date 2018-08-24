<?php
session_start();

$count = 1;
if (isset($_SESSION["count"])) {
    $count = $_SESSION["count"];
    $count++;
}
$_SESSION["count"] = $count;
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Session</title>
</head>
<body>

<?php if ($count == 1) { ?>

    <p>初訪問</p>

<?php } else { ?>

    <?=$count?>回目の訪問です。<BR>

<?php } ?>

</body>
</html>