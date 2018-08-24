<?php

$fp = fopen("member.csv", "r");

echo '<table border="1">';
echo '<tr>';
echo '<th>name</th>';
echo '<th>age</th>';
echo '<th>pref</th>';
echo '<th>belong</th>';
echo '</tr>';

while ($res = fgets($fp, "1024")) {
    echo '<tr>';
    echo '<td>' . $res[0] . '</td>';
    echo '<td>' . $res[1] . '</td>';
    echo '<td>' . $res[2] . '</td>';
    echo '<td>' . $res[3] . '</td>';
    echo '</tr>';
}
echo '</table>';
