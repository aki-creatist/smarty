<?php
/*
今回の学習の流れ
・全体の流れ(ファイル読み込み→投稿があったか確認→投稿があれば入力チェック→ファイルに書き込み)
・while構文
・外部データの取り扱い、ファイル操作
・インクリメント
*/
$data = '';
//ファイルポインタを開く、ファイルと読み込みか書き込みか
//引数はファイルとモード
$fp = fopen('data.txt', 'r');

//一行ずつファイルを読み込む
//読み込みが終わるまでループを繰り返す
$flg = true;
$count = 0;
while ($flg === true) {
    $res = fgets($fp);
    if ($res === false) $flg = false;
    //↓$data = $data  (今までの書き込み全て) + $res
    //  $a . $b 結合

    $data .= $res;
    $count++;
    //var_dump($count);
    if ($count % 2 === 0) $data .= "<br>";
}

//しおりをしまう
fclose($fp);
//よりスマートな書き方はこれ↓
/*
while($res = fgets ($fp)) {
   $data .= $res. "<br>";
}
*/

if (isset($_POST['send']) === true) {
    $name	= $_POST['name'];
    $comment	= $_POST['comment'];

    // var_dump($name);
    if ($name !== '' && $comment !== '') {
        //追加書きの場合モードはa、(新規の上書きはw)
        $fp = fopen('data.txt' , 'a');
        //var_dump($name);
        if (flock($fp, LOCK_EX ) === true) {
            fwrite($fp, $name . "\n" . $comment . "\n");
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    } else {
        echo "名前、またはコメントが入力されていません";
    }
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
    <textarea name="comment" rows="8" cols="30" /></textarea>
    <input type="submit" name="send" value="書き込む" />
</form>

<!-- ここに、書き込まれたデータを表示する -->
<?php echo $data; ?>
</body>
</html>