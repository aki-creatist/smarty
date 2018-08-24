<?php
/*
今回の学習内容
・関数(何度も行うめんどくさい処理はこれで一括で行う)
    メリット
    ・同じような処理を一括で行うためソースコードが読みやすくなる
    ・修正があったときに関数内部の修正を行えばすべての処理に反映させることができる
    ・可読性、保守性の向上
・引数、戻り値、スコープ
 */

define("TAX", 1.08); // 定数

say_hello( "matsumoto");
say_hello( "tanaka");
say_hello( "watababe");
say_hello( "katou");
// say_hello();

say_hello2();
say_hello2("kazuma");

say_hello3( "matsumoto",34);
$price = 1000;
echo $price . '<br>';

$price2 = calc($price) ;

echo $price2;
echo "<br>";
// echo calc($price) . '<br />';
// echo $price2;
echo $price . '<br>';

// 関数の外の$priceは変わらないことに注意
// 関数の中と外では別の変数

function say_hello($name)
{
    echo "hi " . $name . " <br>";
    echo "your name is " .$name . " <br>" ;
    echo "<br>";
}

function say_hello2($name = "hoge")
{
    //初期値ではhoge。変数あればその値を使う
    echo "hi " . $name . " <br>" ;
    echo "your name is " .$name . " <br>" ;
    echo "<br>";
}

function say_hello3($name, $age)
{
    echo  $name ."is " .$age  ." years old"."<br>";
}

function calc($price)
{
    $price = 1.2 * $price;
    $price2 = $price * TAX;
    return $price2; // 戻る変数がある場合はreturnを使う
}
