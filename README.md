# Smartyを利用したサンプルページ

```bash
cd app
make init
cd laradock
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
