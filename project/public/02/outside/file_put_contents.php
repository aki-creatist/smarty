<?php
$filename = __DIR__ . "/test.txt";
$contents = "abcdefghijklmn";
file_put_contents($filename, $contents);
echo "書き込みました。\n";
