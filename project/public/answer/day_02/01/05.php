<?php

$start_month = 6;
$last_month  = 8;

$arrShop = ["A", "B"];

$arrCol  = ["個数", "売上"];

for ($i=6; $i<=8; $i++) {
    $arrMonth[] = $i . "月";
}

echo "<pre>";
print_r($arrMonth);
echo "</pre>";
