<?php
/*
今回の学習内容
・全体の流れ(投稿あったか確認→投稿があれば入力チェックして書き込み→配列への格納→多次元連想配列の表示)
・配列
・while,foreach
 */

if (isset($_POST['send']) === true) {
    $name    = $_POST['name'];
    $comment = $_POST['comment'];

    if ($name !== '' && $comment !== '') {
        $fp = fopen('data2.txt', 'a');
        if (flock($fp, LOCK_EX) === true) {
            fwrite($fp, $name . "\t" . $comment . "\n");
            flock($fp, LOCK_UN);
        }
    } else {
        echo "名前、またはコメントが記入されていません";
    }
}

$excel_array = readData("data2.txt");

// ファイルに書き込まれれたデータを読み込む
function readData($file)
{
    $fp = fopen($file, 'r');
    $excel_array = [];
    while ($res = fgets($fp)) {
        $lines = createArray($res);                // 一行の書き込みを配列に分割
        $excel_array[] = createLabelArray($lines); //連想配列を多次元配列に入れる
    }
    fclose($fp);
    return $excel_array;
}

/**
 * １行のタブ区切りの文字列を配列に分割
 * @param $res
 * @return array
 */
function createArray($res)
{
    return explode("\t", $res);
}

/**
 * 配列を連想配列にする。(ラベルを付ける)
 * @param $lines
 * @return array
 */
function createLabelArray($lines)
{
    $label_array = [
        "name"    => $lines[0], //配列の個々の部分にアクセス
        "comment" => $lines[1]
    ];

    return $label_array;
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>掲示板</title>
</head>
<body>
<form method="post" action="">
    名前
    <input type="text" name="name" value="" />
    コメント
    <textarea name="comment" rows="4" cols="20"></textarea>
    <input type="submit" name="send" value="書き込む" />
</form>
<!-- ここに、書き込まれたデータを表示する -->
<?php
//while_foreach_forのforを説明した後、foreachを説明
foreach ($excel_array as $value) {
    //var_dump($value);
    echo "名前 :" . $value["name"] . "<br>";
    echo "コメント：" . $value["comment"] . "<br><br>";
}
?>
</body>
</html>
