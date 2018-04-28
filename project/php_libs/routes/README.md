# 処理の振り分け

## runメソッドの実行

* 前の手順の基底クラスのコンストラクタの処理が実行された後、runメソッドが実行される
* runメソッド
    * Authクラスの設定とAuthクラスのcheckメソッドにより認証済みかどうかをチェック

## 振り分けの条件

* 次の画面へ移動するには以下２通りのどちらか
    * `リンクをクリックして画面を表示`する
    * `送信ボタンをクリックして画面を表示`する
* `$controller->mode`の値でメソッドが決まる
* 各メソッドの内部では`$this->action`の値で処理を振り分けている
    * 送信ボタンが二つある画面ではボタンの名称を振り分けに利用する

## 画面遷移

| type | action | ボタン | 処理 | 表示画面 |
|:----|:----|:----|:----|:----|
| 無し | - | - | 認証 | 会員画面TOP |
| 無し | - | - | 未認証 | ログイン画面 |
| authenticate | - | - | 認証処理 OK | 会員画面 TOP |
| authenticate | - | - | 認証処理 NG | ログイン画面 |
| regist | form | - | - | 入力画面 |
| regist | confirm | - | 入力チェック OK | 確認画面 |
| regist | confirm | - | 入力チェック NG | 入力画面 |
| regist | complete | 戻る | - | 入力画面 |
| regist | complete | 登録する | INSERT | 完了画面 |
| modify | form | - | - | 入力画面 |
| modify | confirm |  | 入力チェック OK | 確認画面 |
| modify | confirm | - | 入力チェック NG | 入力画面 |
| modify | complete | 戻る | - | 入力画面 |
| modify | complete | 更新する | UPDATE | 完了画面 |
| delete | confirm | - | - | 確認画面 |
| delete | complete | - | DELETE | 完了画面 |
| logout | - | - | ログアウト処理 | ログイン画面 |

## 画面表示までの処理

* 認証済みで`$this->type`に値がない場合
    * 会員トップ画面が表示される
* 認証されていない場合で`$this->type`に値がない場合は
    * ログイン画面が表示される
