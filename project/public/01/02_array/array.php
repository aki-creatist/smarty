<?php

$arr = ["a", "b", "c", "d"];

echo "<pre>";
print_r($arr);
echo "</pre>";

/**
 * 連想配列(ラベルを付けた配列)
 */
echo "<h1>連想配列配列</h1>";
//key => valueという構成
echo "<h3>" . '連想配列に変更' . "</h3>";

$label_arr = [
    "family_name" => "matsumoto",
    "first_name"  => "norio",
    "pref"        => "chiba",
    "language"    => "PHP"
];

print_r($label_arr);

// 個別の値にはkeyでアクセスする。
echo "<h4>" . '$label_arr["language"]にアクセスした結果' . "</h4>";
echo $label_arr["language"];

// 連想配列に値を追加する
// 配列を追加したいときはkeyを添えて入れてあげる感じ
echo "<h4>" . '$laber_arr["hobby"]に値を追加した結果' . "</h4>";
$label_arr["hobby"] = "baseball";
print_r($label_arr);

//  連想配列の値を変更する
echo "<h3>" . '$label_arrの値を変更した結果' . "</h3>";
$label_arr["language"] = "perl";
print_r($label_arr);
echo "<br>";

/**
 * 多次元配列
 */
echo "<h1>多次元配列</h1>";
// 一般的に多く見られるエクセル形式のような配列
// 下記の配列は以下のようなイメージ

//	family_name	first_name	pref		language
// 0	matsumoto	norio		chiba		PHP
// 1	tanaka		youhei		tokyo		C
// 2	satou		ichirou		kanagawa	JAVA

// 配列の中に配列を入れる(カンマを忘れないように！)
// $arr = array("matsumoto", "norio", "chiba");
echo "<h4>" . '$exel_arrをvar_dumpした結果' . "</h4>";

$excel_arr = [
    [
        "family_name" => "matsumoto",
        "first_name"  => "norio",
        "pref"        => "chiba",
        "language"    => "PHP"
    ],
    [
        "family_name" => "tanaka",
        "first_name"  => "youhei",
        "pref"        => "tokyo",
        "language"    => "C"
    ],
    [
        "family_name" => "satou",
        "first_name"  => "ichirou",
        "pref"        => "kangawa",
        "language"    => "Java"
    ]
];
print_r($excel_arr);

// 個別の配列は番号とkeyでアクセス
echo "<h4>" . '$exel_arr[1]を表示' . "</h4>";
print_r($excel_arr[1]);

// 配列へのアクセスの仕方
echo "<h4>" . '$exel_arr[1]["pref"]を表示' . "</h4>";
echo $excel_arr[1]["pref"];

// 多次元配列の値の変更
echo "<h4>" . '$exel_arr[1]["pref"]をosakaに変更' . "</h4>";
$excel_arr[1]["pref"] = "osaka";
echo "<pre>";
print_r($excel_arr);
echo "</pre>";

// 多次元配列の値の変更
//値を追加したいときは番号を入れても良いが、array_pushや$arr2[] = $arrなどを使うと自動的に入る番号を使う
echo "<h3>" . '$exel_arrに値を追加した結果１' . "</h3>";

$excel_arr[3] = [
    "family_name" =>"suzuki",
    "first_name"  =>"jirou",
    "pref"	      =>"saitama",
    "language"    =>"Perl"
];

echo "<pre>";
print_r($excel_arr);
echo "</pre>";

echo "<h3>" . '$exel_arrに値を追加した結果２' . "</h3>";

$arr = [
    "family_name" => "suzuki",
    "first_name"  => "jirou",
    "pref"	      => "saitama",
    "language"    => "Perl"
];

array_push($excel_arr, $arr);
// $excel_arr[] = $arrも全く同じ意味
// 値を追加したいときは番号を入れても良いが、array_pushや$arr2[] = $arrなどを使うと自動的に入る
echo "<pre>";
print_r($excel_arr);
echo "</pre>";

// キーと値を別々に取り出す
$insData = ["A" => "a", "B" => "b", "C" => "c"];
print_r($insData);
echo "<br>";

echo "キーのみ取り出す";
$insDataKey = array_keys($insData);
var_dump ($insData);
echo "<br>";

echo "値のみ取り出す";
$insDataVal = array_values($insData);
var_dump($insData);
echo "<br>";
