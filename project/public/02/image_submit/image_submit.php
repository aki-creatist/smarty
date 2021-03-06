<?php
/*
今回の学習内容
・全体の流れ(投稿あったか確認→画像のエラーチェック→画像のアップロード)
・画像のファイル情報
 */
// 送信ボタンが押されているかどうか
if (isset($_POST['send']) === true) {
    $tmp_image = $_FILES['image'];

    // エラーがなく、サイズが0でないか
    if ($tmp_image['error'] === 0 && $tmp_image['size'] !== 0) {
        // 正しくサーバにアップされているかどうか
        if (is_uploaded_file($tmp_image['tmp_name']) === true) {
            // 画像情報を取得する
            $image_info = getimagesize($tmp_image['tmp_name']);
            $image_mime = $image_info['mime'];

            // 画像サイズが利用できるサイズ以内かどうか
            if ($tmp_image['size'] > 1048576) {
                echo "アップロードできる画像のサイズは、1MBまでです";
                // 画像の形式が利用できるタイプかどうか
            } elseif (preg_match('/^image\/jpeg$/', $image_mime) === 0) {
                echo "アップロードできる画像の形式は、JPEG形式だけです";
            } else if (move_uploaded_file($tmp_image['tmp_name'], './upload_' . time() . '.jpg') === true) {
                echo "画像のアップロードが完了しました";
            }
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>画像アップロード</title>
</head>
<body><!--ファイルのアップロードにはenctype="multipart/form-data"が必要-->
<form method="post" action="" enctype="multipart/form-data">
    <input type="file" name="image" />
    <input type="submit" name="send" value="送信" />
</form>
</body>
</html>
