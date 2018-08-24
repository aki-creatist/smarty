<?php
/*

USE person_db;

CREATE TABLE member_tb (
  member_id int not null auto_increment primary key ,
  name varchar(20) not null,
  age tinyint unsigned  not null,
  sex varchar(2)   not null ,
  language varchar(10) not null ,
  image varchar(50) not null
);

INSERT INTO member_tb(
    name,
    age,
    sex,
    language,
    image
) VALUES
('yamadata',19,'1','PHP','ichigo.jpg');
 */

$name     = isset($_POST['name']) === true ? $_POST['name'] : '';
$age      = isset($_POST['age']) === true ? $_POST['age'] : '';
$sex      = isset($_POST['sex']) === true ? $_POST['sex'] : '';
$language = isset($_POST['language']) === true ? $_POST['language'] : '';
$file_name ="none";

$arr_err_msg = [
    "name"        => '',
    "age"         => '',
    "sex"         => '',
    "image"       => '',
    "language"    => '',
];

$db_host = 'dbserver';
$db_name = 'person_db';
$db_user = 'person_user';
$db_pass = 'person_pass';

// データベースホストへ接続する
$dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';
$dbh = new PDO($dsn, $db_user, $db_pass);

$table = 'member_tb';
$columns = 'name, age, sex, language, image';

if (isset ($_POST['send']) === true) {
    if ($name  === '') {
        $arr_err_msg["name"] = '名を入力してください';   //(※ifの省略表記)
    }

    if (preg_match('/^[0-9]{1,3}$/ ', trim( $age)) === 0) {
        $arr_err_msg["age"] = '数字で年齢を入力してください';
    } elseif (intval($age) < 20) {
        $arr_err_msg["age"] = '20歳未満は応募できません';
    }

    if ($language === '') {
        $arr_err_msg["language"] = '言語を入力してください';   //(※ifの省略表記)
    }

    if ($sex === '') {
        $arr_err_msg["sex"] = '性別を入力してください。';   //(※ifの省略表記)
    }

    if ($_FILES["image"]["error"] !== 4) {
        $tmp_image = $_FILES['image'];

        if ($tmp_image['error'] === 0 && $tmp_image['size'] !== 0) {
            if (is_uploaded_file($tmp_image['tmp_name']) === true) {
                $image_info = getimagesize($tmp_image['tmp_name']);
                $image_mime = $image_info['mime'];
            }
            if ($tmp_image['size'] > 1048576) {
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

    $values  = "$name, $age, $sex, $language, $file_name";

    if ($err_flg === true) {
        $query = "INSERT INTO $table ($columns) VALUES (:name, :age, :sex, :language, :image)";
        $stmt = $dbh->prepare($query);

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);
        $stmt->bindParam(':sex', $sex, PDO::PARAM_STR);
        $stmt->bindParam(':language', $language, PDO::PARAM_STR);
        $stmt->bindParam(':image', $file_name, PDO::PARAM_STR);

        $res = $stmt->execute();

        if ($res !== false) {
            //ファイルUP
            if ($file_name !== 'none') {
                if (move_uploaded_file($tmp_image['tmp_name'], './image/' . $file_name) === true) {
                    echo "success!";
                    exit;
                }
            } else {
                echo "success!";
                exit;
            }
        } else {
            echo "データ入力に失敗しました。";
        }
    }

}

//データの選択
$query = "SELECT $columns FROM $table";

$res = $dbh->query($query);

$arrMember = [];
// 取得したデータを出力
foreach ($res as $value) {
    $arrMember[] = $value;
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
    名前:
    <input type="text" name="name" value="<?=$name?>" />
    <?=$arr_err_msg["name"]?><br />
    年齢:
    <input type="text" name="age" value="<?=$age;?>" size="2" maxlength="3"/>
    <?=$arr_err_msg["age"]?><br />
    画像:
    <input type="file" name="image"  />
    <?=$arr_err_msg["image"]?><br />
    性別:
    <input type="radio" name="sex" value="男" <?php if ($sex === '男') echo "checked"; ?> />男
    <input type="radio" name="sex" value="女" <?php if ($sex === '女') echo "checked"; ?> />女
    <?=$arr_err_msg["sex"]?><br />
    言語:
    <select  name="language">
        <option value="">言語を選んでください。</option>
        <option value="C/C++" <?php if ($language === "C/C++") echo "selected"; ?>>C/C++</option>
        <option value="Java"  <?php if ($language === "Java")  echo "selected"; ?>>Java</option>
        <option value="C#"    <?php if ($language === "C#")    echo "selected"; ?>>C#</option>
        <option value="PHP"   <?php if ($language === "PHP")   echo "selected"; ?>>PHP</option>
        <option value="Perl"  <?php if ($language === "Perl")  echo "selected"; ?>>Perl</option>
        <option value="Ruby"  <?php if ($language === "Ruby")  echo "selected"; ?>>Ruby</option>
    </select>
    <?=$arr_err_msg["language"]?><br />
    <input type="submit" name="send"  value="送信" />
</form>

<table>
    <tr>
        <th>名前</th>
        <th>年齢</th>
        <th>性別</th>
        <th>言語</th>
        <th>画像</th>
    </tr>
    <?php foreach ($arrMember as $member):?>
        <tr>
            <td><?=$member["name"]?></td>
            <td><?=$member["age"]?></td>
            <td><?=$member["sex"]?></td>
            <td><?=$member["language"]?></td>
            <td>
                <?php if ($member["image"] !== "none"): ?>
                    <img src ="image/<?=$member["image"]?>" width="50%">
                <?php endif; ?><br />
            </td>
        </tr>
    <?php endforeach;?>
</table>
</body>
</html>