<?php
$dirname = __DIR__ . "/temp";
if (!is_dir($dirname) && mkdir($dirname)) {
	echo $dirname . "を作成しました。\n";
} else {
	echo $dirname . "は作成できません。\n";
}
