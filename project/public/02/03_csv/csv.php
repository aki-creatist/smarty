<?php
$fp = fopen("read.csv", "r");

while ($res = fgetcsv($fp, "1024")) {
    echo "<pre>" . print_r($res) . "</pre>";
}
