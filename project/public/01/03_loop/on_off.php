<?php

$num = 1;

$flg = true;
// true→false (on→off)
while ($flg === true) {
    if ($num === 10) $flg = false;
    echo $num;
    $num++;
}