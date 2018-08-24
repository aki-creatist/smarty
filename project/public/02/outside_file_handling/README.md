# 外部ファイルの操作

## コンフリクトのテスト

### ゴール

処理が競合し、外部テキストへの書き込みが正常ではないことを確認する

### 手順

* `コンフリクトのテスト`をチェックアウト
* ブラウザでタブを２つ開く
* 両画面で同一のURLにアクセス
    * http://localhost:8081/input.php
* 両画面のフォームを埋める
* 片側ずつ順に送信ボタンを押下する

### 確認

book.txtを開き、以下のようなデータになっていることを確認する

```text
2018年 01月 04日 00:20:55	A	2018年 01月 04日 00:20:58	C	B
D
```

## ロックによるコンフリクト防止のテスト

### 手順

* `ロックによるコンフリクト防止のテスト`をチェックアウト
* あとは前の手順と同様

### 確認

book.txtを開き、以下のようなデータになっていることを確認する

```text
2018年 01月 04日 00:26:59	A	B
2018年 01月 04日 00:27:04	C	D	
```

## 読み込み処理

* book.txtが存在しない状態で以下のURLにアクセス
    * http://localhost:8081/read.php
    * ファイルが開けませんでした。と表示されていること
* book.txtが存在する状態で以下の同URLにアクセス
    * テキストファイルの内容が表示されていること

## クッキーの追加

```diff
+## クッキーの追加
+
+### 確認
+
+* read.phpにアクセスをし、一同投稿をする
+* ページを遷移し、再度新規の状態で開いた際に名前が残っていることを確認する
diff --git a/var/www/html/input.php b/var/www/html/input.php
index 1bda98d..7820c35 100644
--- a/var/www/html/input.php
+++ b/var/www/html/input.php
@@ -1,8 +1,10 @@
+<?php require_once './encode.php'; ?>
 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="UTF-8" />
     <title>外部ファイル操作</title>
+    <?php $cookie_name = isset($_COOKIE['name']) ? $_COOKIE['name'] : ''; ?>
 </head>
 <body>
 <h3>書き込み</h3>
@@ -10,7 +12,8 @@
     <div id="container">
         <label for="name">お名前：</label>
         <input type="text" id="name" name="name"
-               size="20" maxlength="30" />
+               size="20" maxlength="30"
+               value="<?=e($cookie_name)?>" />
     </div>
     <div id="container">
         <label for="message">メッセージ：</label>
diff --git a/var/www/html/write.php b/var/www/html/write.php
index 3c89daf..a217000 100644
--- a/var/www/html/write.php
+++ b/var/www/html/write.php
@@ -18,4 +18,5 @@ fclose($fp_tmp_file);
 fclose($fp_target_file);
 unlink($target_file);
 rename($tmp_file, $target_file);
+setcookie('name', $_POST['name'], time() +(60 * 60 * 24 * 90));
 header('Location: ' . $header);
```