<?php

$zip1 = "123";
$zip2 = "5678";

if (preg_match('/^[0-9]{3}$/', $zip1) === 1 &&
    preg_match('/^[0-9]{4}$/', $zip2)=== 1) {
    echo 'OK';
} else {
    echo 'NG';
}

echo "<br><br>";

$tel1 = "0123";
$tel2 = "4567";
$tel3 = "8901";

if (preg_match('/^[0-9]{1,6}$/', $tel1) ===1 &&
    preg_match('/^[0-9]{1,6}$/', $tel2) ===1 &&
    preg_match('/^[0-9]{1,6}$/', $tel3) ===1 &&
    preg_match($tel1 . $tel2 . $tel3 ) <= 11 ) {
    echo 'OK';
} else {
    echo 'NG';
}
