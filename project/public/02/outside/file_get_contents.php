<?php
$filename = __DIR__ . "/test.txt";
if (is_readable($filename)) {
	$contents = file_get_contents($filename);
	echo $contents . "\n";
} else {
	echo $filename . "は読み込めません。\n";
}
