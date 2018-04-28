## 起点ファイル

### index.phpの実行

* ${DIR}/index.php
    * 会員または未登録のユーザーがアクセス
* premember.php
    * 登録中の会員がアクセス
* system.php
    * 管理者がアクセスする

```php
<?php
require_once '../../php_libs/init.php';
$controller = new ${機能名}Controller();
${名前空間}\run($controller);
```
