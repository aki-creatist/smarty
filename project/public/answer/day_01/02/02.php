<?php
$productArr = [
    [
        "code"    => "A0001",
        "product" => "白菜（1玉）",
        "price"   => 298
    ],
    [
        "code"    => "K0001",
        "product" => "いわし（5尾）",
        "price"   => 240
    ],
    [
        "code"    => "A0002",
        "product" => "九条葱（1パック）",
        "price"   => 258
    ],
    [
        "code"    => "A0003",
        "product" => "サツマイモ（1袋）",
        "price"   => 180
    ],
    [
        "code"    => "K0002",
        "product" => "きびなご（１皿）",
        "price"   => 180
    ]
];

echo "<table border='1px'>";
echo "<tr>";
echo "<th>code</th>";
echo "<th>product</th>";
echo "<th>price</th>";
echo "</tr>";

foreach ($productArr as $product) {
    echo "<tr>";
    echo "<td>" .$product["code"] ."</td>";
    echo "<td>" .$product["product"] ."</th>";
    echo "<td>" .$product["price"] ."</td>";
    echo "</tr>";
}
echo "</table>";
