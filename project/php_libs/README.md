# 概要

## init.php

* 設定ファイルの中の定数名には` _ `を前につける
    * ユーザ定義定数ということがわかるようにするため

### 設定の意味

* 設定ファイルの定義と意味を解説する
* `_DEBUG_MODE`
    * `true`にすると`Smarty`の`Debug`画面が別画面として表示される
    * 通常画面の下にセッション変数の内容が表示される
* `_MEMBER_SESSNAME`
* `_SYSTEM_AUTHINFO`
    * セッション関連の定数
* `_MEMBER_FLG`と`_SYSTEM_FLG`
    * 会員用機能を利用するか管理者用機能を設定するためのもの
* `_PHP_LIBS_DIR`には、関連ファイルの設置ディレクトリまでの絶対パスを設定する
* `_ROOT_DIR`
    * index.phpなどエントリポイントとなるファイルの位置をそれぞれのファイル内部で定義
* `_CLASS_DIR`
    * このシステムの中心となるクラスファイルが格納される
* `_SMARTY`で始まる定数
    * テンプレートエンジンSmartyに関連する設定
    
### ファイルの読み込み

* 動作に必要な全てのファイルを読み込む
* Baseと付いているファイルは先に読み込
    * 順序を変えるとエラーになる
