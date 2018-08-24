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
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>無題ドキュメント</title>
</head>

<body>
<table border="1px">
    <tr>
        <th>月</th>
        <th>商品数</th>
        <th>個数</th>
        <th>売上</th>
    </tr>
    <?php foreach ($arrShopSales as $month => $shopSaleData): ?>
    <tr>
        <td rowspan="<?php echo count($shopSaleData);?>"><?=$month;?></td>
        <?php foreach ($shopSaleData as $shop => $sale): ?>
            <td><?=$shop;?></td>
            <td><?=$sale["個数"]?></td>
            <td><?=$sale["売上"]?></td>
    </tr>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
