<?php
$line1 = "AKI\tHello";
$line2 = "YUNA\tGoodMorning";

$lines1 = explode("\t", $line1);
$lines2 = explode("\t", $line2);

$label_array1 = [
    "name"    => $lines1[0],
    "comment" => $lines1[1]
];

$label_array2 = [
    "name"    => $lines2[0],
    "comment" => $lines2[1]
];

$excel_array = [
    $label_array1,
    $label_array2
];

var_dump($excel_array);