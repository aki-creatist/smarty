<h4>PHPの配列</h4>

<?php
    $prod_data = [
        ['製品名', '価格'],
        ['iPhone', 86800],
        ['iPad', 53800]
    ];

    $row = 3;
    $col = 2;

    echo "<table border='1px'>";
    for ($y = 0; $y < $row; $y++) {
        echo "<tr>";
        for ($x = 0; $x < $col; $x++) {
            echo "<td>";
            echo $prod_data[$y][$x];
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
?>