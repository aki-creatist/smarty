# Controller

## MemberController

* getUpdateFormData
    * 会員IDを取得
        * 管理者
            * URLパラメータから会員IDを取得
        * 会員
            * Sessionから会員IDを取得
    * 会員情報を取得
        * 会員テーブル内のデータ
        * 郵便番号/住所
        * 誕生日
            * 年
            * 月
            * 日
    * 会員情報を返却
    