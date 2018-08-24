<?php

$fp = fopen("sales.csv", "r");

while ($res = fgetcsv($fp)) {
    $month = $res[0];
    $shop = $res[1];
}

var_dump($month);
var_dump($shop);
