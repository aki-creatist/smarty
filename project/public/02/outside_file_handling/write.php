<?php
$header = $_SERVER['HTTP_HOST'] . '/input.php';
$target_file = __DIR__ . '/book.txt';
$tmp_file = __DIR__ . '/book.tmp';
$fp_target_file = fopen($target_file, 'rb');
$fp_tmp_file = fopen($tmp_file, 'wb');
flock($fp_target_file, LOCK_SH);
flock($fp_tmp_file, LOCK_EX);
fputs($fp_tmp_file, date('Y年 m月 d日 H:i:s')."\t");
fputs($fp_tmp_file, $_POST['name']."\t");
fputs($fp_tmp_file, $_POST['message']."\n");
while ($row = fgets($fp_target_file)) {
    fputs($fp_tmp_file, $row);
}
flock($fp_tmp_file, LOCK_UN);
flock($fp_target_file, LOCK_UN);
fclose($fp_tmp_file);
fclose($fp_target_file);
unlink($target_file);
rename($tmp_file, $target_file);
header('Location: ' . $header);