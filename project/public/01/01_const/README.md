# 定数

## 概要

* PHPには、あらかじめ値が設定された「定数」がある
    * PHPのコード実行中に変更することのない値を格納したもの
        * 定義済みの定数
            * 例：`PHP_VERSION`には使用しているPHPのバージョンが格納されている
        * 定義する定数
            * 例：DBの接続情報を定義する、など
* 定数名には慣習的に大文字が使用される
* `true`、`false`、`null`なども定数

## 言語ごとの差異

* PHP
* Javascript

### JavaScript

* `constキーワード`を用いて定義
* 定数識別子の構文は変数識別子の構文と同じ
* PHPのクラス内での定数の定義と類似
* 識別子ルール
    * 文字、アンダースコア、ドル記号から始める
    * アルファベット、数値、アンダースコアを含めることができる
* 定数のスコープルール
    * ブロックスコープ変数と同じ
        * ブロックの中で定義した定数はブロックの外では参照不可

```javascript
if (A == 0) {
    const B = 100;
    var C = 200;
    alert(B);	//100
}
alert(C);	//200
alert(B);	//Uncaught ReferenceError: B is not defined
```

### PHP

* `define関数`を用いて定義
    * `define("定数名","定義する値")`
* 定義はスクリプトのどこからでも利用できる

```php
<?php
define("HELLO","こんにちは!!");
echo HELLO; // 「こんにちは!!」と表示され
?>
```

#### マジック定数

* PHPにはマジック定数と呼ばれるものがある
    * 利用状況によって自動的に定義される
        * 例：実行中のファイル名など
        
<table>
<tr><th>定数</th><th>意味</th></tr>
<tr><td>PHP_VERSION</td><td>PHPのバージョン</td></tr>
<tr><td>PHP_OS</td><td>PHPが稼働中のOS</td></tr>
<tr><td>__LINE__</td><td>処理中の行番号</td></tr>
<tr><td>__FILE__</td><td>処理中のPHPファイルのフルパスをファイル名</td></tr>
<tr><td>__DIR__</td><td>処理中のファイルがあるディレクトリ名</td></tr>
<tr><td>__FUNCTION__</td><td>関数名</td></tr>
<tr><td>__CLASS__</td><td>クラス名</td></tr>
<tr><td>__TRAIT__</td><td>トレイト名</td></tr>
<tr><td>__METHOD__</td><td>クラスのメソッド名</td></tr>
<tr><td>NAMESPACE</td><td>「名前空間の名称</td></tr>
<tr><td>true</td><td>真</td></tr>
<tr><td>false</td><td>偽</td></tr>
<tr><td>null</td><td>何も値がない</td></tr>
</table>