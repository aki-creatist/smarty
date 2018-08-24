# javascript

## 要素の選択

* `Documentオブジェクト` の `getElementById`メソッドを使う
    * このメソッドは要素に設定したIDを引数にする
    * Elementオブジェクト(のインスタンス)を返す
        * ElementオブジェクトはHTMLの要素を表す
    * 要素がレンダリングされた状態でなければ選択できない
    
```javascript
// nameにはElementオブジェクトが返る
var name = document.getElementById('name_id').value;
```

## オブジェクトとインスタンス

* インスタンスとは `実体` という意味
    * 大元のオブジェクトのクローンをイメージするとよい
        * 元になったオブジェクトと、全く同じプロパティとメソッドを持る
    * インスタンスは`new オブジェクト()`の形式で作成する
        * `オブジェクト名()`は`コンストラクタ`と呼ばれる特殊な関数

## Elementオブジェクト

* Elementオブジェクトは多数のメソッドとプロパティを持つ
    * 今回使用するプロパティ
        * `className`
            * 要素のクラス名を取得・設定するプロパティ
        * `innerHTML`
            * 要素の子を取得・設定

* headタグ内の<script>タグはbody要素内がレンダリングされるより先に実行される
    * まだIDが対象のIDの要素は存在していない
        * getElementByIdはインスタンスがないことを示す「null」という値を返します。
        * その結果、次の「elem.className」はnullに対して実行される
        * `Cannot set property 'className' of null`
            * (nullのclassNameプロパティは設定できない)というエラーが発生する

以上を確認のため、以下をコメントアウト

```javascript
// window.onload = fillBasket;
// function fillBasket()
// {
    var elem = document.getElementById('basket');
    elem.className = 'filled_basket';
    elem.innerHTML = '<p>商品が入る</p>';
// }
```

* 上記のような特定のタイミングで処理を実行する仕組みを`イベント`という
    * 以下２つが目的の要素がレンダリングされた後で処理を実行するための役に立っている
        * `window.onload = fillBasket;` 
        *  `function fillBasket()`

## サンプル

### オブジェクトの扱い

#### Dateオブジェクト

[calendar.html](calendar.html)
[calendar.js](calendar.js)

* JavaScriptの日付や時刻を処理は、`Dateオブジェクト`を使用する
    * Dateオブジェクトを利用するには`new Date()`とする
        * `new演算子`は`インスタンス`を作成する演算子
        * `new Date()`の引数が空の場合
            * 今日の日付を記憶したインスタンスが作成される
        * `new Date(年, 月, 日 );`と日付げが指定されている場合
            * 特定の日付のDateインスタンスが作成される
* Dateオブジェクトのインスタンスは`一つの日付を記憶`する
    * 複数の日付を記憶させる場合は、複数のインスタンスを作る
* Dateオブジェクトでは`月数のみ0〜11の数値`で表す
    * Dateオブジェクトに渡す時は１を引く
        * `var d = new Date(year, month-1, date);`
    * Dateオブジェクト取り出した時は１を足す
        * `document.write( (d.getMonth()+1) + '/' + d.getDate() + '<br>' + `

処理の概要

* 日付を求める
    * `y * 10 + x + 1` という計算を行う
        * カウンタ変数xは`0〜9`で変化
        * カウンタ変数yは`0〜3`で変化
    * この式によって1〜40で変化する値が得らる
* `Dateオブジェクト`の効果
    * 不使用の場合
        * `1月32日〜1月40日`が表示される
    * 使用の場合
        * `1月40日`を日数を渡しても、`2月9日`が返される
    * `getDayメソッド`を利用すると、曜日を取り出せる
        * 返り値は`0〜6`の数値
        * 日曜日が0、土曜日が6
        * 配列感変数を作成し、`'日'〜'土'`というテキストを記憶
        * キーに該当する曜日を出力する
    
    