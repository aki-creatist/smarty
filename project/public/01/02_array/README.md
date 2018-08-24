# 配列

```bash
FILE_PATH='var/www/html/array'

JS_ARRAY="${FILE_PATH}/js_array.html"
PHP_ARRAY="${FILE_PATH}/php_array01.php"

JS_OBJECT="${FILE_PATH}/js_object.html"
PHP_ARRAY2="${FILE_PATH}/php_array02.php"

# 配列をjavascriptとPHPで比較する
diff ${JS_ARRAY} ${PHP_ARRAY}
# javascriptのオブジェクトとPHPの連想配列を比較する
diff ${JS_OBJECT} ${PHP_ARRAY2}
```

## 目次

* 配列の並べ替え操作
    * 配列内のデータの並び替え
        * 昇順に並べ替える
        * 降順順に並べ替える
    * 連想配列内のデータの並べ替え
        * データを基準にソートする関数
            * 昇順に並べ替える
            * 降順順に並べ替える
        * キーを基準にソートする関数
            * 昇順に並べ替える
            * 降順順に並べ替える
* 配列データの追加/削除の操作
    * 配列末尾データの追加削除
        * 末尾にデータを追加する
        * 末尾にデータを削除する
    * 配列先頭データの追加削除
        * 先頭にデータを追加する
        * 先頭にデータを削除する
* 配列の結合と切り出し
    * 配列に配列を取り込む
    * 配列から欲しい箇所だけ切り出す
* データを反転する

## 配列の並び替え操作

* 文字は使用している文字コードの順に並べ替えられる
* 半角記号、半角英数字、ひらがな、カタカナ、感じ、全角数字、全角英字、全角カタカナの順に並ぶ
    * UTF-8の文字コードの順番に並べ替えられるため
    * ひらがなやカタカナはほぼ五十音順に並ぶ
    * 漢字は、JIS第一水準漢字は音読順、JIS第二水準漢字は画数順に並ぶ


### 配列内のデータの並び替え

#### 昇順に並べ替える

* 配列内のデータが小さい方から大きい方へ並べ替えられる
* インデックスは並べ変えた順に付け直される

```php
sort(配列)
```

```php
$numbers = [18, 7, 20, 5];
sort($numbers);
echo "<pre>";
print_r($numbers); // 5 7 18 20
echo "</pre>";
```

#### 昇順に並べ替える

* 配列内のデータが大きい方から小さい方へ並べ替えられる
* Reverceの`r`

```php
rsort(配列);
```

```php
$numbers = [18, 7, 20, 5];
rsort($numbers);
echo "<pre>";
print_r($numbers); // 20 18 7 5
echo "</pre>";
```

### 連想配列内のデータの並べ替え

* 連想配列には、関数がソートする基準が２つある
    * `データを基準にソートする関数`
    * `キーを基準にソートする関数`

#### データを基準にソートする関数

##### 昇順に並べ替える

* 連想配列に格納されているデータを基準に昇順にソート
* 配列内のデータが小さい方から並べ替える
* AssociativeArray(連想配列)の`A`

```php
asort(配列);
```

```php
$sales = ["TV2" => "1000", "TV1" => "500", "RADIO1" => "800"];
asort($sales);
echo "<pre>";
print_r($sales); // 1000 800 500
echo "</pre>";
```

##### 降順に並べ替える

* 配列のデータの大きい方から小さい方へ並べ替える
* AssociativeArrayの`A`とReverceの`R`

```php
$sales = ["TV2" => "1000", "TV1" => "500", "RADIO1" => "800"];
arsort($sales);
echo "<pre>";
print_r($sales); // 1000 800 500
echo "</pre>";
```

#### キーを基準にソートする関数

##### 昇順に並べ替える

* 連想配列に格納されているキーを基準に昇順にソートする
* 配列内のキーが、データとの関連はそのままで`文字コードの`小さい方から大きい方へ並べ替えられる

```php
ksort(配列);
```

```php
$sales = ["TV2" => "1000", "TV1" => "500", "RADIO1" => "800"];
ksort($sales);
echo "<pre>";
print_r($sales); // RADIO1 TV1 TV2
echo "</pre>";
```

##### 降順に並べ替える

* 連想配列に格納されているキーを基準に降順にソートする
* 配列内のキーが、データとの関連はそのままで文字コードの大きい方から小さい方へ並べ替えられる

```php
krsort(配列)
```

```php
$sales = ["TV2" => "1000", "TV1" => "500", "RADIO1" => "800"];
krsort($sales);
echo "<pre>";
print_r($sales); // RADIO1 TV1 TV2
echo "</pre>";
```

## 配列データの追加/削除の操作

### 配列末尾データの追加削除

#### 末尾にデータを追加する

* `$配列[] = "文字列"`のようにしても同じことができる
* 関数を利用することで、複数の文字列や変数を `,` で区切って引数に指定し、一度に追加することができる

```php
array_push($配列, "追加文字列");
array_push($配列, $追加変数);
```

```php
$data = ["りんご", "みかん"];
array_push($data, "なし", "すいか");
echo "<pre>";
print_r($data); // りんご みかん なし すいか
echo "</pre>";
```

#### 末尾のデータを削除する

* 配列の末尾からデータを一つ取り出して変数に格納する
* 配列は、取り出したデータ一つ分だけ短くなる

```php
$data = ["りんご", "みかん", "かき"];
$kaki = array_pop($data);
echo "<pre>";
print_r($data); // りんご みかん
echo "</pre>";
echo $kaki; // かき
```

### 配列先頭データの追加削除

#### 先頭のデータを追加する

* 配列先頭に１つ以上のデータを追加することができる
* 複数の文字列や変数を追加するには、`,` (カンマ)で区切って引数に指定

```php
array_unshift($配列, "追加文字列");
array_unshift($配列, $追加変数");
```

```php
$data = ["りんご", "みかん"];
array_unshift($data, "パパイヤ", "かき");
echo "<pre>";
print_r($data); // パパイヤ かき りんご みかん
echo "</pre>";
```

#### 先頭のデータを削除する

* 配列の先頭からデータを一つ取り出して変数に格納することができる
* 配列の「先頭」からデータを一つ取り出せる
* インデックス(番号)は先頭に向かって一つずれる

```php
$変数 = array_unshift(配列);
```

```php
$data = array("りんご", "みかん", "かき");
$apple = array_shift($data);
echo <pre>;
print_r($data); // みかん かき
echo "</pre>";
echo $apple; // りんご
```

## 配列の結合と切り出し

### 配列に配列を取り込む

* 二つの配列(または連想配列)を結合して、新たな配列を作成することができる

```php
$配列 = array_merge( $元の配列, $追加配列);
```

```php
$data     = ["TV1" => "500", "TV2" => "1000", "RADIO1" => "800"];
$add_data = ["TV1" => "2000", "RADIO2" => "600"];
$result   = array_merge($data, $add_data);
echo "<pre>";
print_r($result); // TV1 => 2000 TV2 => 1000 RADIO1 => 800 RADIO2 => 600
echo "</pre>";
```

### 配列から欲しい箇所だけ切り出す

* `開始位置`から`長さ`だけ、配列のデータを連続して取り出して、新しい配列へ格納できる
    * 開始位置
        * 配列の最初のデータを`0`とする
        * 開始位置が`負のとき`
            * `配列末尾を0`として先頭に向かって数える
    * 長さ
        * 長さが`負のとき`
            * 開始位置と配列末尾から長さだけ先頭に移動したその位置との間のデータを取り出せる
        * 長さを`省略`
            * 開始位置から配列の最後まで取り出せる

```php
$配列 = array_slice( $元の配列, 開始位置, 長さ);
```

```php
$data   = array("A", "B", "C", "D", "E");
echo implode(',', $data) . '<br>'; // A,B,C,D,E

// 0番目から4つ取り出す (A,B,C,Dを取り出す)
$result = array_slice($data,  0,  4);
echo implode(',', $result) . '<br>'; // A,B,C,D

// 開始位置が負のとき (Cを取り出す)
$result = array_slice($data, -3,  1);
echo implode(',', $result) . '<br>';

// 長さが負のとき (Dを取り出す)
$result = array_slice($data,  3, -1);
echo implode(',', $result) . '<br>';

// 長さを省略 (C,D,Eを取り出す)
$result = array_slice($data,  2);
echo implode(',', $result) . '<br>';
```

## データを反転する

* 配列に格納されているデータを反転(逆順)することができる
* ファイルと使った掲示板などは記事データを配列に入れて、この関数で反転させることで、新しい記事をページの上側に表示することができる

```php
$配列 = array_reverse( $元の配列 );
```

```php
$data   = ["A", "B", "C", "D", "E"];
$result = array_reverse($data);
echo "<pre>";
print_r($result); // E,D,C,B,A
echo "</pre>";
```