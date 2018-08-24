<?php
$start_month = 6;
$last_month  = 8;

$arrShop = ["A", "B"];

$arrCol  = ["個数", "売上"];

for ($i=6; $i<=8; $i++) {
    $arrMonth[] = $i . "月";
}

$fp = fopen("sales.csv", "r");
$arrShopSales = [];

foreach ($arrMonth as $month) {
    foreach ($arrShop as $shop) {
        foreach ($arrCol as $col) {
            $arrShopSales[$month][$shop][$col] = 0;
        }
    }
}

while ($res = fgetcsv($fp)) {
    $month = $res[0];
    $shop = $res[1];

    $arrShopSales[$month][$shop]["個数"] += $res[2];
    $arrShopSales[$month][$shop]["売上"] += $res[3];
}

echo "<pre>";
print_r($arrShopSales);
echo "</pre>";