# 外部ファイルの操作

## 基本的なファイル操作

* ファイルの操作
    * [書き込む](file_get_contents.php)
    * [読み込む](file_get_contents.php)
    * [削除する](unlink.php)
    * [パス情報を取得する](pathinfo.php)
    * [コピーする](copy.php)
    * [文字コードを変換する](mb_convert_encoding.php)
* ディレクトリの操作
    * [作成](mkdir.php)
    * [削除](rmdir.php)

## 概要

コマンドラインから実行し、外部ファイルを操作する

## ファイルの操作

* copy.php
* file_put_contents.php
* file_get_contents.php
* mb_convert_encoding.php
* unlink.php

### copy

```php
copy("コピー元ファイル名", "コピー先ファイル名);
```

### mb_convert_encoding

$変数に格納した文字列の文字コードを指定した文字コードに変換する

```php
// UTF-8からSJISへ変換してファイルに書き込む例
mb_convert_encoding("ファイル名", "SJIS", "UTF-8");
```

## ディレクトリの操作

* mkdir.php
* rmdir.php
    
### mkdir

```php
mkdir(ディレクトリ名);
```

### rmdir

```php
rmdir(ディレクトリ名);
```

## 実行コマンド

[file_handling.sh](file_handling.sh)

## ファイルの権限の変更

操作するファイルは権限が適切に設定されている必要がある

ファイルのユーザとApacheを実行するユーザが異なるとエラーになるため。

```bash
sudo chmod 646 外部ファイルの名前.txt
```

