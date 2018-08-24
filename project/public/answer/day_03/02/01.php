<?php

$db_host = 'dbserver';
$db_name = 'person_db';
$db_user = 'person_user';
$db_pass = 'person_pass';

$dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';
$dbh = new PDO($dsn, $db_user, $db_pass);

//データの選択
//ヒアドキュメント
$query = <<< EOF
     SELECT
        name,
        age,
        language
      FROM
        person_tb
EOF;

//$query = "SELECT name, age, language FROM person_tb";

$res = $dbh->query($query);

foreach ($res as $value) {
    $arrMember[] = $value;
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>テーブル表示</title>
</head>
<body>

<table border="1px">
    <tr>
        <th>名前</th>
        <th>年齢</th>
        <th>使用言語</th>
    </tr>
    <?php foreach ($arrMember as $key => $row): ?>
    <tr>
        <td><?=$row["name"]?></td>
        <td><?=$row["age"]?></td>
        <td><?=$row["language"]?></td>
        <?php endforeach; ?>
    </tr>
</table>
</body>
</html>