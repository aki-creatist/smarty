<h4>PHPの連想配列</h4>

<?php
$prod_data = [
    ["name"=>'iPhone', "price"=>86800],
    ["name"=>'iPad', "price"=>53800]
];

$row = 2;
echo "<table border='1px'>";
//見出し
echo '<tr><th>製品名</th><th>単価</th></tr>';
//データ行
for ($i = 0; $i < $row; $i++) {
    echo '<tr>';
    echo '<td>' . $prod_data[$i]["name"] . '</td>';
    echo '<td>' . $prod_data[$i]["price"] . '</td>';
    echo '</tr>';
}
echo '</table>';
?>