# ５日目小テスト

## 問１

* ４日目課題の問２に、JavaScriptを使って、以下の要素を加えてください。
* ボタンを押した時、未入力の場合、色をピンク表示にする

## 問２

以下の内容でパスワードを作成し、ブラウザに表示させてください。

* 文字数は、12〜16文字です。
* 使う文字は、下のA〜Dタイプから選んでください。
* 必ず、すべてのタイプの文字を最低一回は使うようにしてください。

| タイプ | パスワード |
|:----|:----|
| A | "abcdefghijklmnopqrstuvwxyx"; |
| B | "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; |
| C | "0123456789"; |
| D | "!¥"#$%&'()"; |


## UNIXのタイムスタンプ

* UNIXのタイムスタンプとは、UNIX epochと呼ばれる1970年1月1日からの秒数をいう
* time関数では西暦1970年1月1日から実行した時の日時まで秒数を取得可能

## 日付をUNIXのタイムスタンプとして取得する

* 日付(文字列)からUNIXのタイムスタンプを求めるにはmktime関数を使用
* 引数として時間、分を分割して指定して、結果を変数で受け取り可能

```php
$変数 = mktime( 時間,分,秒,月,日,年 );
```

* 例では、mktime関数に日付を分割して指定して、結果を変数$timestampに格納し、print文で表示

```php
$timestamp = mktime( 0, 0, 0, 7, 3, 2015 );
print $timestamp;
```

## UNIXタイムスタンプを日付にする

* date関数を使用すれば、UNIXタイムスタンプを日付に戻すことが可能
* time関数やmktime関数などと組み合わせることにより、何日後や何日前の日付を取得可能

```php
$変数 = date( フォーマット, UNIXタイムスタンプ);
```

* 例では、time関数で取得したタイムスタンプに、一週間分の秒数を加算して、一週間後のタイムスタンプを作成して、$timestampに格納
* date関数にフォーマット用記号「'Y年m月d日H時i分s秒'」と$timestampを指定して実行すると、$next_weekに一週間後の日付を取得可能
* フォーマット用記号はここで使用した以外にも多数ある
* なお、UNIXタイムスタンプを指定しない場合は、現在の日時のタイムスタンプを使用する

```php
//time関数で取得したタイムスタンプと1週間分の秒数を加算して

$timestamp = time() + ( 60 * 60 * 24 ) * 7;

//フォーマット用記号と$timestampを指定して$timestampに格納します。

$next_week = date( 'Y年m月d日H時i分s秒', $timestamp );

//$next_weekに一週間後の日付を取得できます。

print $next_week;
```

## foreachの参照渡し

* 配列の展開時に参照渡しを行うことで、展開後の配列の値を変化させることができる

```php
<?php
foreach($dataArr as $key => &$data)
{
~省略~
}
````

* 通常は配列をforeachで展開中の処理の中で変数の値を変化させたとしても、その後の配列の値に影響はない

```php
<?php
$arr = array( "aaa", "bbb" );
var_dump($arr); echo "";
foreach($arr as $refer) {
    if ($refer == "bbb") {
        $refer = "ccc";
    }
}
var_dump($arr);
?>
```

* 以下のような結果になります。</p>

```text
array(2) { [0]=> string(3) "aaa" [1]=> string(3) "bbb" }
array(2) { [0]=> string(3) "aaa" [1]=> string(3) "bbb" }
```

* ご覧の通り、foreach内で実行された処理は、元の変数には影響を与えない
* 次に、展開された値を参照渡しにして実行

```php
<?php
$arr = array("aaa", "bbb");
var_dump($arr); echo "";
foreach($arr as &$refer) {
    if ($refer == "bbb") {
        $refer = "ccc";
    }
}
var_dump( $arr );
?>
```

* 変数に `&` が付与されることで、これ以降、この変数の値に変化があった場合にはその値を優先するという性質が加わる
* 配列の展開後の配列の値が変化します。実行結果は以下の通り

```text
array(2) { [0]=> string(3) "aaa" [1]=> string(3) "bbb" }
array(2) { [0]=> string(3) "aaa" [1]=> &string(3) "ccc" }
```

* 上記のように、展開後の変数の値が変更されていることに注目

```php
~省略~
var_dump($arr); echo "";
$refer = "eee";
var_dump($refer); echo "";
var_dump($arr);
```

* 配列の展開後に、$referに文字列"eee"を代入する
* すると、配列の最後の値が変更されてしまう

```text
array(2) { [0]=> string(3) "aaa" [1]=> &string(3) "eee" }
```

* 以上のように、配列の値が変更されてしまう
* 使用の仕方には注意が必要
