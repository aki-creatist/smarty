<?php
$copy_file = __DIR__ . '/test.txt';
$copied_file = __DIR__ . '/test.bk';

if (copy($copy_file, $copied_file)) {
    echo "コピーに成功しました。\n";
} else {
    echo "コピーできませんでした。\n";
}
