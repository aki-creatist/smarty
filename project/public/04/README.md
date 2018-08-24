# ４日目小テスト

## 問1-1

* 以下の使用で、クラスを作ってください

## クラス名 student


| 変数名 | 種類 | 初期値 |
|:----|:----|:----|
| name | public | 空 |
| age | public | 空 |
| pref | public | 空 |

## コンストラクタ

| 引数 | 戻り値 | 内容 |
|:----|:----|:----|
| $name, $age, $pref | なし | クラス内の変数に引数を代入する |

| メソッド名 | 引数 | 戻り値 | 内容 |
|:----|:----|:----|:----|
| showData | $tbl_flg | なし | 入力されたデータを以下の形式で表示する<br><ul><li>$tbl_flgが"1"ならばテーブル表示<li>そうでなければecho表示</ul> |

echo表示

* matsumoto's profile
* matsumoto is 32 years old
* matsumoto is from chiba

## テーブル表示

* matsumoto's profile

| name | age | pref |
|:----|:----|:----|
| matsumoto | 32 | chiba |


## 1-2

* 自分の名前、年齢、出身地をいれてインスタンスを生成し、showDataで自分のデータを表示させてください

## 1-3

* 以下のデータをCSVデータで保存し、読み込んで、「tbl_flg」が「１」の人はテーブル表示、そうでない人はecho表示してください。

| name | age | pref | tbl_flg |
|:----|:----|:----|:----|
| yamada | 33 | chiba | 1 |
| katou | 23 | tokyo | 0 |
| suzuki | 16 | kanagawa | 1 |
| watanabe | 29 | saitama | 0 |


## 1-4

* 問1-1　〜　問1-3までで作ったクラスを継承し、自分で考えた表示方法を追加してください。

## 問２

* ３日目課題の問３のエラーチェックをクラス化し、テンプレート部分をSmartyで表示させてください

