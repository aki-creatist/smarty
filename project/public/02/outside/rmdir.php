<?php
$dirname = __DIR__ . "/temp";

if (is_dir($dirname) && rmdir($dirname)) {
    echo "ディレクトリ(./temp)を削除しました\n";
} else {
    echo "ディレクトリが見つかりません。\n";
}

