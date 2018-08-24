# 入力検証(補足)

## 検証に利用できるclass属性の種類

* require
    * 値が入力されているかをチェック
        * 必須検証
* regexp
    * 正規表現パターンに合致するかをチェック
        * フォーマット検証
* length
    * 文字列の長さが指定文字数を超えていないかをチェック
        * 文字列検証
* renge
    * 数値がm~nの範囲に含まれるかをチェック
        * 数値範囲検証
* inarray
    * 入力値が候補リストのいずれかに合致するかをチェック
        * 候補値検証

[入力必須検証](../README.md)で触れたもの以外に利用できる検証パラメータ

* 検証種類
    * `パラメータ名` 概要

以下

* `require`
    * `-` 省略
* `regexp`
    * `data-pattern` フォーマットチェックに利用する正規表現パターン
* `lentgh`
    * `data-length` 許可する最大の文字列長
* `renge`
    * `data-max` 許可する数値の上限
    * `data-min` 許可する数値の下限
* `inarray`
    * `data-option` 許可する候補値のリスト(空白区切) 

## 各概要

### 文字列長検証 length

* 文字列長検証の条件式
    * `$(this).al().length > $(this).data('length')`
    * 文字列の長さはlengthプロパティでdata-length属性にセット
    * 許可する最大の文字列長はdata-length属性にセット
    * dataメソッドで取得できる
* 両者を比較し、前者が大きい場合にエラーとみなす

```javascript
$(this).al().length > $(this).data('length')
```

### 数値範囲検証 range

* 入力値vと最小値(min)/最大値(max)を比較
    * 比較前に入力値をparseFloatメソッドで数値に変換
    * val、dataメソッドはいずれも文字列を返す
        * いずれかを数値に変換しておかないと、正しく数値としての比較ができなる

```javascript
var v = parseFloat($(this).val());
if ( v < $(this).data('min') || v > $(this).data('max')) {
```

```javascript
parseFloat(数値に変換したい文字列)
```

### 候補値検証 inarray

* 許可する候補リストを作成
    * 検証対象となる要素のdata-option属性で「A社 B社 Cシステム」のように空白区切りでセット
    * splitメソッドで、空白で文字列を分割
        * 候補リストを表す配列optsを作成
* 入力値が配列の中に含まれているかをチェック
    * 配列のチェックは`$.inArrayメソッド`
        * 値が配列の南蛮目に含まれているかを返す
            * 先頭は0
            * 値が見つからなかった場合は-1

```javascript
文字列.split(区切り文字)
```

```javascript
$.inArray(値, 配列)
```

`$.inArray`メソッドの返り戻り値が-1であればエラー

```javascript
var opts = $(this).data('option').split(' ');
if ($.inArray($(this).val(), opts) === -1) { // -1 = 中身がないの意味
```