<?php
if (isset( $_POST['send'] ) === true) {
    $str = $_POST["str"];
//$str = "1111222233334444";
    $byte = 16;
}

$flg = checkByte($str, $byte);
if ($flg) {
    echo "<font size='14'>" . "OKです。" . "</font>";
} else {
    echo "<font size='14'>" . "エラーです。" . "</font>";
    echo $byte;
    echo "<span style='color: red;'>" . "バイトを超えています。" . "</span>";
}

function checkByte($str, $byte)
{
    $strlen = strlen($str);

    if ($strlen <= $byte) {
        return true;
    }
    return false;
}