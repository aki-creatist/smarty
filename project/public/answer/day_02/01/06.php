<?php

$start_month = 6;
$last_month  = 8;

$arrShop = ["A", "B"];

$arrCol  = ["個数", "売上"];

for ($i=6; $i<=8; $i++) {
    $arrMonth[] = $i . "月";
}

foreach ($arrMonth as $month) {
    foreach ($arrShop as $shop) {
        foreach ($arrCol as $col) {
            $arrShopSales[$month][$shop][$col] = 0;
        }
    }
}
echo "<pre>";
print_r($arrShopSales);
echo "</pre>";
