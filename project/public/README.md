## 起点ファイル

### index.phpの実行

* ${DIR}/index.php
    * 会員または未登録のユーザーがアクセス
* member/premember.php
    * 登録途中のユーザがメールで送信されたリンクをクリックして行う
* system/system.php
    * 管理者がアクセスする

```php
<?php
require_once '../../php_libs/init.php';
$controller = new ${機能名}Controller();
${名前空間}\run($controller);
```

## 本人確認用テンプレート

* premember.tpl
    * メール送信されたパスワード付きリンクをクリックした時に画面表示に使用される
    * テンプレートトップページに移動するためのリンクが変数`{$SCRIPT_NAME}`ではなく`index.php`と直接記されている
    * メッセージを表示するため、`{$message}`を記述している

### 結果を確認する

* 登録処理を実行すると、同時に登録したアドレス宛にメールが送信される
* メール内に記述されたURLをクリックする
* テンプレートファイルpremember.tplを使った画面に`登録完了した。トップページよりログイン。`と表示される
