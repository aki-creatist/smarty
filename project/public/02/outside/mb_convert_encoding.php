<?php
$filename = __DIR__ . "/test.txt";
$contents = "あいうえおかきくけこ";
$contents = mb_convert_encoding($contents, "SJIS", "UTF-8");
file_put_contents($filename, $contents);
echo "書き込みました。\n";
