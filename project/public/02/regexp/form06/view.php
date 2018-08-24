<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ファイルアップロード</title>
</head>
<body>
<?php
$file_dir  = './image/';

$file_path = $file_dir . $_FILES["uploadfile"]["name"];

// move_uploaded_file(一時ファイル名,移動先のファイル名)
// 「一時ファイル名」をチェックして「移動先のファイル名」にファイルを移動
if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $file_path)) {
    $img_dir  = "./image/"; // 参照する際の画像の場所
    $img_path = $img_dir. $_FILES["uploadfile"]["name"];
    $size     = getimagesize($file_path);
    ?>
    ファイルアップロードを完了しました。<br>
    <img src="<?=$img_path?>" <?=$size[3]?>><br>
    <b><?=$_POST["comment"]?></b><br>
<?php } else { ?>
    正常にアップロード処理されませんでした。<br>
    <?php } ?>
</body>
</html>