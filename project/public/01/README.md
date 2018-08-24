# １日目小テスト

## 問１
### 問1-1 連想配列の定義

* 次のような連想配列が定義されています

```text
$arr = ['name'=> '松本', 'age' => '33', 'pref' =>'千葉', 'sex' => '男']
```
    
この配列を以下のように表示してください

```text
name:松本
age:33
pref:千葉
sex:男
```

### 問1-2 要素の追加

* 問1-1で定義された配列に、language=>PHPを追加してください

### 問1-3 多次元配列を定義

* 次のデータを多次元配列で定義してください

| | name | age | pref | sex | language |
|:----|:----|:----|:----|:----|:----|
| 0 | 田中 | 22 | 千葉 | 男 | C |
| 1 | 鈴木 | 19 | 東京 | 女 | Java |
| 2 | 吉田 | 27 | 神奈川 | 男 | C++ |

### 問1-4 データの追加

* 1-3の多次元配列に以下のデータを追加してください

| name | age | pref | sex | language |
|:----|:----|:----|:----|:----|
| 渡辺 | 26 | 大阪 | 男 | Perl |

### 問1-5 デーブル作成

* 1-4でできた配列をテーブルで表示させてください

## 問２

### 問2-1 多次元配列の定義

| code | product | price |
|:----|:----|:----|
| A0001 | 白菜（1玉） | 298 |
| K0001 | いわし（5尾） | 240 |
| A0002 | 九条葱（1パック） | 258 |
| A0003 | サツマイモ（1袋） | 180 |
| K0002 | きびなご（１皿） | 180 |
            
### 問2-2 ターブル作成

* 上記、配列をテーブル表示してください

### 問2-3 要素の計算

* 合計金額と個数を表示してください

## 問３

* 以下のような多次元連想配列があります

```text
$data = [
    ["name"=>"山田", "age"=>"19", "sex"=>"1"],	
    ["name"=>"鈴木", "age"=>"22", "sex"=>"0"],	
    ["name"=>"田中", "age"=>"18", "sex"=>"1"],	
    ["name"=>"渡辺", "age"=>"25", "sex"=>"0"],	
    ["name"=>"佐藤", "age"=>"33", "sex"=>"1"]	
];
```

### 問3-1 テーブルの作成

* 多次元連想配列をテーブルタグを使って表形式で表示させてください。
    * 性別は1は男、0は女で表示してください。

### 問3-2 if + foreach

* 20歳未満の人には"〜さんは未成年なのでお酒はまだ飲めません"、
    * 20歳以上の人には"〜さん、飲み過ぎに注意しましょう！"と、全員表示してください。

### 問3-3 要素の計算

* ??の中をプログラムで計算して値を出し、以下のように表示してください。
    * 男性メンバー	??人 (平均年齢??歳)
    * 女性メンバー	??人 (平均年齢??歳)