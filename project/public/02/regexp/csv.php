<?php
$fp = fopen("read.csv", "r");

$i   = 1;
$flg = true;

while ($res = fgetcsv($fp, "1024")) {
    $div_date = explode("-", $res[1]);
    if (preg_match('/^[0-9]{4}$/', trim($res[0])) === 0 ||
        checkdate($div_date[1], $div_date[2], $div_date[0]) === false ||
        preg_match('/^[0-9]{1}$/', $res[2]) === 0) {
        echo $i . "行目にエラーがあります<br />";
        $flg = false;
    }
    echo "<pre>";
    var_dump($res);
    echo "</pre>";
    $i++;
}

if ($flg === true) {
    echo "正常に終了しました";
}
