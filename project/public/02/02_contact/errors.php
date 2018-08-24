<?php
// 初期データを設定
$data = [
    'family_name'      =>'',
    'first_name'       =>'',
    'family_name_kana' =>'',
    'first_name_kana'  =>'',
    'gender'           =>'',
    'year'             =>'',
    'month'            =>'',
    'day'              =>'',
    'zip1'             =>'',
    'zip2'             =>'',
    'address'          =>'',
    'email'            =>'',
    'tel1'             =>'',
    'tel2'             =>'',
    'tel3'             =>'',
    'traffic'          =>'',
    'contents'         =>''
];

// エラーメッセージの定義、初期
$errors = [];
foreach ($data as $key => $value) {
    $errors[$key] = '';
}

if ($data['family_name'] == "") $errors['family_name'] = "お名前(氏)を入力してください";
if ($data['first_name'] == "")  $errors['first_name'] = "お名前(名)を入力してください";
if ($data['sex'] == "")         $errors['sex'] = "性別を選択してください";
if ($data['year'] == "")        $errors['year'] = "生年月日の年を選択してください";
if ($data['month'] == "")       $errors['month'] = "生年月日の月を選択してください";
if ($data['day'] == "")         $errors['day'] = "生年月日の日を選択してください";
if ($data['zip1'] == "")        $errors['zip1'] = "半角英数字３桁で入力してください";
if ($data['zip2'] == "")        $errors['zip2'] = "半角英数字４桁で入力してください";
if ($data['address'] == "")     $errors['address'] = "住所を入力してください";
if ($data['email'] == "")       $errors['email'] = "メールアドレスを正しい形式で入力してください";
if ($data['tel1'] == "")        $errors['tel1'] = "電話番号は、半角数字で11桁以内で入力してください";
if ($data['traffic'] == "")     $errors['traffic'] = "最低一つの交通機関を入力してください";
echo "<pre>";
print_r($errors);
echo "</pre>";