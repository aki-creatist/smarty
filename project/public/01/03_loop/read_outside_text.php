<?php

// ファイルポインタ　本のしおり
$fp = fopen('sample_text.txt', "r");
//$fp →　リソース型の変数
$flg = true ;
while ($flg === true) {
    // fgets ←データの情報を取ってくる
    $res = fgets($fp);
    // fgetsが終点に到達するとfalseを返します。
    if ($res === false) $flg = false;
    echo $res . "<br>";
}
fclose($fp);
