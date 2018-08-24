<?php
var_dump($_GET);

$data = ["渡辺", "佐藤", "田中"];

$id = isset($_GET["id"]) === true ? $_GET["id"] : "";

if ($id !== "") echo $data[$id];

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>GETテスト</title>
</head>
<body>
<?php
$domain = 'http://localhost:8080';
$path = 'get/';
$file = 'get.php';
$url = $domain . '/' . $path . $file;
?>

<p><a href="<?= $url . '?id=0'; ?>">クリックすると渡辺さんが表示されます。</a></p>
<p><a href="<?= $url . '?id=1'; ?>">クリックすると佐藤さんが表示されます。</a></p>
<p><a href="<?= $url . '?id=2'; ?>">クリックすると田中さんが表示されます。</a></p>
</body>
</html>
