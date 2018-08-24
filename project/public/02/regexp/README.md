# 事前知識

各フォームを扱う前の事前知識

## 各フォーム

データの取得までを想定しているため、前提として`name`属性は必須とする

`name`属性はデータ受け取り側が『フォームの中のどの部品か』を判断する目印

### テキスト入力

* `input`タグのtype属性に`text`を設定
    * `name`属性に任意の名前をつけることができる

### ラジオボタン

* `input`タグのtype属性に`radio`を設定
    * 各選択肢のname属性に、全て同じキーを設定しグループ化
        * グループから一つだけ選択するという操作が可能

```html
<input type="radio" name="キー1" value="データ1">データ1
<input type="radio" name="キー1" value="データ2">データ2

//上のラジオボタンとは別のグループ
<input type="radio" name="キー2" value="データ1">データ1
<input type="radio" name="キー2" value="データ2">データ2
//グループごとに同じname属性を付けます
```

### pulldown

* `select`タグの配下に`option`タグを列挙
    * 通常`列挙する選択肢は配列で用意`する
    * 配列を展開することで`option`タグを量産する

* １つ目の選択肢はデータ受信時に『未選択』であることをわかりやすく
    * value属性に「""」を設定して、データが何も送信されないようにする

```html
<select>
    <option value="" selected>選択してください</option>
    <option value="1">送信する値が1</option>
    <option value="2">送信する値が2</option>
</select>
```

### チェックボックス

* `input`タグのtype属性に`checkbox`を設定
    * 選択肢は`配列で用意`することが多い
    * 配列を展開することで`input`タグを量産する


```html
<input type="checkbox" name="フォーム名" value="データ1">データ1
<input type="checkbox" name="フォーム名" value="データ2">データ2
```

#### ポイント - name属性に配列を指定する

チェックボックスの値を受け取る時には配列で受け取ると後の処理が簡単

例えば`$_POST["キー"][1]`に`データ2`が格納される

手順は以下

* チェックされた選択肢だけ、そのvalue属性が$_POSTに格納されて送信する
    * name属性に配列を表す[]をキー名と一緒に設定
        * データ1とデータ2にチェックをつけて送信

```html
<input type="checkbox" name="キー[]" value="データ1">データ1
<input type="checkbox" name="キー[]" value="データ2">データ2
```

### TextArea

* `textarea`タグを指定する
    * `cols`と`rows`で入力欄の広さを設定可能
    * `textarea`タグは閉じる必要がある

```html
<textarea cols="3" rows="2"></textarea>
```

#### ポイント - `<br>`タグを追加する

* HTML内では`<br>`タグがないと改行されない
    * 送信された文字列内に改行はブラウザでは改行せずにつながった一続きの文章
* `nl2br`を利用する
    * 引数に受け取った値を指定する
        * これにより行末に`<br>`タグを追加した文字列が返される
        * 厳密には`<br>`ではなく、XHTML互換の`<br />`

### hedden

* `<input>`タグのtype属性に`hidden`を指定
    * name属性には受け取り時に使うキーを設定
    * データはvalue属性に設定

```html
<input type="hidden" name="キー" value="データ">
```

### SubmitButton

* `<input>`タグのtype属性に`submit`を指定
    * `value属性`に設定した文字列がWebページ上でボタンの名称として表示される
    
* １つの`form`タグの中に送信ボタンを2個以上設定する場合
    * `name属性`に任意のキーを設定

```html
<input type="submit" name="すすむ" value="すすむ">
<input type="submit" name="もどる" value="もどる">
```
    
