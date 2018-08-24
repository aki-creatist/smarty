<?php
$errors['zip1'] = '';
$errors['zip2'] = '';

$rule_zip1 = '/^[0-9]{3}$/';
$rule_zip2 = '/^[0-9]{4}$/';

$zip1 = isset($_POST['zip1']) === true ? $_POST['zip1'] : '';
$zip2 = isset($_POST['zip2']) === true ? $_POST['zip2'] : '';

if (isset($_POST["send"]) ===  true) {
    if (preg_match($rule_zip1 , $zip1) === 0) {
        $errors['zip1'] = '郵便番号の上は半角数字3桁で入力してください';
    }
    if (preg_match($rule_zip2, $zip2) === 0) {
        $errors['zip2'] = '郵便番号の下は半角数字4桁で入力してください';
    }
}
