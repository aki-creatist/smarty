<?php

$family_name = (isset($_POST['family_name']) === true ) ? $_POST['family_name'] : '';
$first_name  = (isset($_POST['first_name']) === true ) ? $_POST['first_name'] : '';
$age         = (isset($_POST['age']) === true ) ? $_POST['age'] : '';
$zip_code    = (isset($_POST['zip_code']) === true ) ? $_POST['zip_code'] : '';
$address     = (isset($_POST['address']) === true ) ? $_POST['address'] : '';
$note        = (isset($_POST['note']) === true ) ? $_POST['note'] : 'none';
$file_name ="none";

$arr_err_msg = [
    "family_name" => '',
    "first_name"  => '',
    "age"         => '',
    "zip_code"    => '',
    "image"       => '',
    "address"     => '',
];

if (isset($_POST['send']) === true) {  //クリックされたかされてないかの判定
    //投稿がある場合のみ以下の処理を行う
    if ($family_name === '') $arr_err_msg["family_name"] = '氏を入力してください';
    if ($first_name  === '') $arr_err_msg["first_name"] = '名を入力してください';   //(※ifの省略表記)

    if (preg_match('/^[0-9]{1,3}$/ ', trim($age)) === 0) {
        $arr_err_msg["age"] = '数字で年齢を入力してください';
    }

    if ($zip_code === '') {
        $arr_err_msg["zip_code"] = '郵便番号を入力してください';
    } elseif (preg_match('/^[0-9]{7}$/ ', trim( $zip_code)) === 0) {
        $arr_err_msg["zip_code"] = '数字7桁で郵便番号を入力してください';
    }

    if ($address  === '') $arr_err_msg["address"] = '住所を入力してください';   //(※ifの省略表記)

    // ファイルがテンプレされていない場合、$_FILES["image"]["error"]は4になる
    if ($_FILES["image"]["error"] !== 4) {

        $tmp_image = $_FILES['image'];

        if ($tmp_image['error'] === 0 && $tmp_image['size'] !== 0) {

            if (is_uploaded_file($tmp_image['tmp_name']) === true) {
                $image_info = getimagesize($tmp_image['tmp_name']);
                $image_mime = $image_info['mime'];
            }

            if ( $tmp_image['size'] > 1048576) {
                $arr_err_msg["image"] = "アップロードできる画像のサイズは1MBまでです";
            } elseif (preg_match('/^image\/jpeg$/', $image_mime) === 0) {
                $arr_err_msg["image"] = "アップロードできる画像の形式はJPEG形式だけです";
            } else {
                $file_name = $tmp_image['name'];
            }
        }
    }

    $err_flg = true;
    foreach ($arr_err_msg as $key => $err_msg) {
        if ($err_msg !== '') $err_flg = false;
    }

    if ($err_flg === true) {
        $fp = fopen("list.txt", "a");

        $contents = $family_name . ","
            . $first_name . ","
            . $age . ","
            . $zip_code . ","
            . $address . ","
            . $file_name . ","
            . $note . "\n";

        if (flock($fp, LOCK_EX) === true) {
            fwrite( $fp, $contents);
            flock( $fp, LOCK_UN);
        }

        fclose($fp);

        //ファイルUP
        if ($file_name !== 'none') {
            if (move_uploaded_file($tmp_image['tmp_name'], './image/' . $file_name) === true) {
                echo "success!";
                exit;
            }
        }
    }
}

//ここからは読み込み
$fp = fopen("list.txt","r");

$arrContents = [];
while ($res = fgetcsv($fp)) {
    $contents = [
        "family_name" =>$res[0],
        "first_name"  =>$res[1],
        "age"         =>$res[2],
        "zip_code"    =>$res[3],
        "address"     =>$res[4],
        "image"       =>$res[5],
        "note"        =>$res[6]
    ];

    $arrContents[] = $contents;
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム</title>
</head>
<body>

<form method="post" action="" enctype="multipart/form-data">
    氏:
    <input type="text" name="family_name" value="<?php echo $family_name; ?>" />
    <?php echo $arr_err_msg["family_name"] ; ?><br />
    :名:
    <input type="text" name="first_name"  value="<?php echo $first_name; ?>" />
    <?php echo $arr_err_msg["first_name"] ; ?><br />
    年齢:
    <input type="text" name="age"         value="<?php echo $age; ?>" />
    <?php echo $arr_err_msg["age"] ; ?><br />
    郵便番号:
    <input type="text" name="zip_code"   value="<?php echo $zip_code; ?>" />
    <?php echo $arr_err_msg["zip_code"] ; ?><br />
    住所:
    <input type="text" name="address"    value="<?php echo $address; ?>" />
    <?php echo $arr_err_msg["address"] ; ?><br />
    画像:
    <input type="file" name="image"  />
    <?php echo $arr_err_msg["image"] ; ?><br />
    備考:
    <input type="text" name="note"  />
    <br>
    <input type="submit" name="send"  value="送信" />
</form>

<table border="1px">
    <tr>
        <th>氏</th>
        <th>名</th>
        <th>年齢</th>
        <th>郵便番号</th>
        <th>住所</th>
        <th>画像</th>
        <th>備考</th>
    </tr>

    <?php
    foreach ($arrContents as $contents) {

        echo "<tr>";
        echo "<td>" . $contents["family_name"] . "</td>";
        echo "<td>" . $contents["first_name"] . "</td>";
        echo "<td>" . $contents["age"] . "</td>";
        echo "<td>" . $contents["zip_code"] . "</td>";
        echo "<td>" . $contents["address"] . "</td>";

        if ($contents["image"] !== "") echo '<td><img src="image/' . $contents["image"] . '" width="40%"></td>';

        echo "<td>" . $contents["note"] . "</td>";

        echo "</tr>";
    }
    ?>
</table>
</body>
</html>