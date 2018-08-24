<?php require_once './encode.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>外部ファイル操作</title>
</head>
<body>
<h3>読み込み</h3>

<?php
$file = @fopen('book.txt', 'rb')
or die('ファイルが開けませんでした。');
flock($file, LOCK_SH);
?>

<dl>
    <?php while ($row = fgetcsv($file, 1024, "\t")) { ?>
        <dt><?=e($row[1])?>（<?=e($row[0])?>）</dt>
        <dd>メッセージ:<?=e($row[2])?><hr /></dd>
    <?php } ?>
</dl>

<?php
flock($file, LOCK_UN);
fclose($file);
?>
</body>
</html>
