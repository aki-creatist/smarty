<?php
require_once 'constants.php'; // 都道府県一覧を読み込み

$html = "<SELECT name=\"prefecture\" >\n";

for ($i = 0; $i <= count($prefecture_list) - 1 ; $i++) {
    $html .= "<OPTION value=\"$i\">$prefecture_list[$i]</OPTION>\n";
}
$html .= "</SELECT>\n";

echo $html;
