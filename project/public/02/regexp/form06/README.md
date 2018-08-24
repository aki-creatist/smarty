# ファイルアップロード

* Webサーバにファイルを転送する
    * 画像を転送して画面に表示

## ファイルを送受信するには

* 送信
    * `form`タグの`enctype`属性に`multipart/form-data`を指定
* 受信
    * ファイルがアップロードされると、一時的な名前をつけられて保存される
    * 処理せずリクエスト処理(送信)が終わるとその時点でファイルは削除される
    * `$_FILE`を使用し処理をする

## 処理

### ファイルを移動する

* 変数にファイルパスとファイル名を格納
    * 実際の名前は`$_FILES["upload file"]["name"]`に格納されている
* move_uploaded_file関数を使って移動
    * 一時ファイルは削除
    * move_uploaded_file関数はTRUEを返し、IFブロックの中の処理を実行します。


```php
move_uploaded_file(一時ファイル名,移動先のファイル名)
```

```php
//「一時ファイル名」をチェックして「移動先のファイル名」にファイルを移動
if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $file_path)) {
```

### 画像を表示する

* WebサーバのDocumentRootから見たファイルの移動先パスを格納
* `getimagesize()`で指定した画像の情報を取得
    * 配列`$size`で返される
        * `$size[3]`に、画像の大きさが`widh="xx" heght = "xx"`形式で格納される
* 正常に移動後`<img>`タグの`src`属性に`移動先パス`を指定
    * 移動先パスはここでは`$img_path`
* 画像サイズとして`$size[3]`を指定
