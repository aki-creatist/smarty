<?php
$filename = __DIR__ . "/test.txt";
if (is_file($filename) && unlink($filename)) {
	echo $filename . "を削除しました。\n";
} else {
	echo $filename . "は削除できません。\n";
}
