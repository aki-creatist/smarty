# Smartyを利用したサンプルページ

```bash
cd app
make init
cd laradock
rm -rf adminer aerospike aws caddy certbot DOCUMENTATION elasticsearch grafana haproxy hhvm kibana laravel-echo-server maildev mailhog memcached mariadb minio mongo mssql neo4j percona pgadmin postgres postgres-postgis rabbitmq rethinkdb solr varnish
docker-compose up -d nginx mysql redis beanstalkd
```

## 概要

* DB
    * [都道府県データの取得](Makefile)
    * [DBの作成](docker/database/initdb.d/1_create_db.sh)
    * [テーブルの作成](docker/database/initdb.d)
    * [初期データ挿入](docker/database/initdb.d/4_import.sql)

## 確認

```bash
docker exec mysql mysql -uroot -ppass -Dproject -e 'SHOW TABLES;'

#Docker起動時に初期データが投入されたことを確認
docker exec mysql mysql -uroot -ppass -e 'SELECT COUNT(*) FROM project.contents'
docker exec mysql mysql -uroot -ppass -e 'SELECT COUNT(*) FROM project.members'
docker exec mysql mysql -uroot -ppass -e 'SELECT COUNT(*) FROM project.premembers'
docker exec mysql mysql -uroot -ppass -e 'SELECT COUNT(*) FROM project.traffics;'
docker exec mysql mysql -uroot -ppass -e 'SELECT COUNT(*) FROM project.zipcode;'
docker exec mysql mysql -uroot -ppass -e 'SELECT COUNT(*) FROM project.member_traffics;'
docker exec mysql mysql -uroot -ppass -e 'SELECT COUNT(*) FROM project.member_zipcode;'


docker exec mysql mysql -uroot -ppass -e 'SELECT pref,city FROM project.zipcode limit 1;'
docker exec mysql mysql -uroot -ppass -e 'SELECT * FROM project.traffics;'
docker exec mysql mysql -uroot -ppass -e 'SELECT * FROM project.members\G'
docker exec mysql mysql -uroot -ppass -e 'SELECT * FROM project.contents\G'

docker exec mysql mysql -uroot -ppass -e 'DESC project.contents'
docker exec mysql mysql -uroot -ppass -e 'DESC project.members'
docker exec mysql mysql -uroot -ppass -e 'DESC project.premembers'
docker exec mysql mysql -uroot -ppass -e 'DESC project.traffics'
docker exec mysql mysql -uroot -ppass -e 'DESC project.zipcode'
docker exec mysql mysql -uroot -ppass -e 'DESC project.member_traffics'
docker exec mysql mysql -uroot -ppass -e 'DESC project.member_zipcode'
```

| ファイル名 | クラス名 | 説明 |
|:----|:----|:----|
| Auth.php | Auth | 認証用クラス |
| BaseController.php | BaseController | コントローラの基底クラス |
| BaseModel.php | BaseModel | モデルの基底クラス |
| KenController.php | KenController | 未使用 |
| KenModel.php | KenModel | 県名を取り出す機能のみ |
| MemberController.php | MemberController | 会員システムの各機能。会員と非会員の振り分け |
| MemberModel.php | MemberModel | 会員データの検索・登録・更新・削除 |
| PrememberController.php | PrememberController | メールアドレスの確認処理 |
| PrememberModel.php | PrememberModel | 会員データの検索・登録・削除 |
| SystemController.php | SystemController | MemberControllerを利用した管理機能 |
| SystemModel.php | SystemModel | 管理者データの検索機能のみ |

# 会員登録機能概要

* ログインID入力ルール
    * ログインIDは一意でなければならない
    * ログインIDはユーザー自身が入力する
    * ログインIDは変更可能である
    * ログインIDには、以下の文字のみ使用可能とする
    * 半角数字(0-9)
    * 半角アルファベット(A-z)
    * ※大文字／小文字の区別を行う
    * ログインIDの入力に3回失敗するとアカウントロックされる
* メールアドレス入力ルール
    * メールアドレスは一意でなければならない
    * メールアドレスは確認用を含めて2回入力する
    * メールアドレスは＠とドメインを含まなければならない
    * メールアドレスのドメインはシステムが許可したものだけとする
* 注文入力ルール
    * 注文は1度に5商品までとする
    * 注文は1度に2箇所まで配送先を選択できる
    * 注文は次の決済方法から1つ選択する
        * 銀行振込
        * クレジットカード決済

# 会員管理システムの構成

* IDとパスワードをDBに登録して認証する会員機能を作成していく
* 全体の構成を検討する

# システムの概要

## 開発方針

* ここでの目標は認証機能により制限されたページを作成すること
* 登録画面などで利用する入力フォームはXAMPPに標準で含まれているHTML_QuickFormを利用する
    * 入力チェックが簡単に実装可能
* 一覧画面のページ切り替えには、同じくPagerを利用
* テンプレート式にしたいので、テンプレートエンジンのSmarty3を利用

## 会員機能の概要

* はじめに、閲覧者は、ゲストとしてWebページを表示して、登録フォームにより会員登録を行う
* 登録した直後、閲覧者のメールアドレス宛に本人を確認するための確認メールが送信される
* メールで送られたURLにアクセスすると、登録が完了
* 登録すると、IDとパスワードによりログインして、会員専用のページを表示させる
* 会員専用ページから、登録した情報を修正及び削除(退会処理)可能

## 管理機能の概要

* メールで情報の修正や退会処理を求められることがあるため会員システムには管理機能が必要になる
* 管理者は専用のページから、登録検索、修正、削除の各操作を行えるようにする
* 管理者も共通のログインシステムを利用してログイン可能
    * ただし、IDやパスワードはDBに直接登録する
    * 安全性を高めるためには、`.htaccess`ファイルを利用して自分のIPアドレスのみをアクセス可能にしておく

## クラスの分割方法

* Webアプリケーションを開発するときによく聞く言葉にMVCと呼ばれる設計技法がある
* MVCとはモデル(Model)、ビュー(View)、コントローラ(Controller)のそれぞれの頭文字
    * Modelは、中心になる要素となりDBに接続してデータを処理
    * ViewはModelのデータをHTMLに組み立ててクライアントに返す
    * Controllerはクライアントから入力されたデータを受けとってModelとViewを制御
* 会員情報をDBに登録するときにmemberデーブルを作成する場合、MemberModel、MemberControllerを作成する
* Smartyを利用するため、Viewクラスは作成しない
* MemberModelにはDBとのやりとりをすべて含める
* MemberControllerでは、グローバル変数やセッション変数を参照して処理や画面を振り分ける

# デーブルを設計するには

* 会員システムの機能を実現するために必要なデータを検討して、データを正規化して、テーブル定義を行う

# テーブル定義

## 機能に必要なデータ

* 複雑なシステムの場合は、ER図と呼ばれる図を使って概念設計から始めるが、ここで作成するシステムは単純なものなので、簡単に必要なデータを検討して直接SQLとして記述
* 今回、少なくともログイン用のユーザーネームやパスワードを格納する会員情報テーブルが必要になる
* ２、本人確認に使う仮登録テーブルも必要
* これは会員情報テーブルのデータに本人確認済みかどうかを示すフラッグを追加したテーブルにする
* 住所に使う都道府県は、３、県名テーブルを作成して、県名idを会員情報テーブルや仮登録テーブルに格納する


| テーブル名 | 用途 |
|:----|:----|
| 会員情報テーブル | 名前、ユーザーネームやパスワードなど会員情報を格納 |
| 仮登録テーブル | 会員情報テーブルに確認済みフラッグを追加したもの |
| 県名テーブル | 都道府県をを格納 |

## 正規化

* テーブルに格納するデータを決定するときにデータの正規化を行う必要がある
* 正規化とは１件のレコードの中に同じカラム(フィールド)が含まれないようにテーブルの構造を決定すること
* あわせて、適切にテーブルを分割して、記憶容量やプログラミングなどの効率を考える必要がある
    * 例えば、年齢は誕生日から求められるため、年齢カラムは不要
    * 会員情報テーブルは、会員数が多くなった場合は、ログインに利用するユーザーネームとパスワードは分割して別のテーブルにするとログイン時の検索が早くなる
* このように正規化されたデータのことを正規形と呼ぶ
* 処理効率を考えてあえて冗長なデータを残すこともある
    * これは非正規化という

## リレーショナルDB

* MySQLは、複数のテーブルをリレーション(関係)と呼ばれる関係で相互に連結してデータを操作することができるリレーショナルDB
* 主キーと呼ばれる番号を別のテーブルのレコードに持たせることでこのつながりを実現する
    * こうすることで、同じデータは、一つのテーブルにだけ格納すればよく、記憶容量の無駄を省ける
    * 新たな機能を追加するために会員のデータを追加したいときも、新規テーブルに会員番号を追加するだけで相互に連結可能

# 詳細設計

## 会員情報テーブル

* 会員登録には、会員情報テーブル(member)を使用
    * 主キーは、ユーザーID
    * この種キーが同じものや主キーがないレコードは登録不可能
* ログインのためのユーザーネームは、重複せずに、覚えやすいメールアドレスを利用
* メールアドレスは、カラム「username」に格納
* Auth(認証)クラスでこのカラム名と次のパスワード「password」を利用
* 次の誕生日は「20050823」の形式で文字列として格納
* 住所は県名だけと、登録日、退会日にはDATETIME型と呼ばれる日付を扱うデータ形式で保存
* 最後に「id」が主キーとなるように定義を行う
* INSERT 文でテストデータを挿入
* データの中の`$2y$10$jUa?`は、「pass」という文字列を`crypt`関数で暗号化したもの
    * なお、コードの先頭の「DROP TABLE IF EXISTS member,」は、重複したテーブルが存在したら削除するSQL文

```sql
DROP TABLE IF EXISTS member;
CREATE TABLE member (
id          MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
username   	VARCHAR(50),
password   	VARCHAR(128),
last_name  	VARCHAR(50),
first_name 	VARCHAR(50),
birthday   	CHAR(8),
ken         SMALLINT,
reg_date   	DATETIME,
cancel      DATETIME,
PRIMARY KEY (id)
);

INSERT  INTO member (username, password, last_name, first_name, birthday, ken, reg_date, cancel)  VALUES('user',   '$2y$10$jUaIP/qDbBFIJFEPfd/W2ewsCIzoGPrbxCaHOdWjwQFUNRGoKT4DS',   '〇田',  '〇夫',  '20130101','1', now(),   NULL);

```

# 県名テーブル

* 県名テーブル(ken)は、idと県名だけのテーブルでidを主キーとして定義する
* テーブルに47の県名を登録しておき、会員情報テーブルのカラム「ken」にこのidを登録

```sql
DROP TABLE IF EXISTS ken;
CREATE TABLE ken (
id      SMALLINT,
ken     VARCHAR(10),
PRIMARY KEY (id)
);

INSERT  INTO ken (id, ken) VALUES(  1,'北海道');
INSERT  INTO ken (id, ken) VALUES(  2,'青森県');

~中略~

INSERT  INTO ken (id, ken) VALUES( 46,'鹿児島県');
INSERT  INTO ken (id, ken) VALUES( 47,'沖縄県');
```

## 仮登録テーブル

* 新規登録するには、まず仮登録テーブル(premember)にデータを保存しておく
* 仮登録テーブルのテーブル定義は会員情報テーブルにlink_pass(リンク用パスワード)と、reg_date(登録日時：DATETIME型)を追加したものになる
* 作成したSQL文はmysqlコマンドラインツールを利用してsampledb内に読み込んで、これら３つのテーブルを作成する

```sql
DROP TABLE IF EXISTS premember;
CREATE TABLE premember (
id          MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
username   	VARCHAR(50),
password   	VARCHAR(128),
last_name  	VARCHAR(50),
first_name 	VARCHAR(50),
birthday   	CHAR(8),
ken         SMALLINT,
link_pass  	VARCHAR(128),
reg_date   	DATETIME,
PRIMARY KEY (id)
);
```
