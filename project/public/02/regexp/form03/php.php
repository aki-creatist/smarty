<?php
$error_php = '';
$int_test = isset($_POST['int_test']) === true ? $_POST['int_test'] : '';
if (isset($_POST["send"]) ===  true) {
    if (preg_match('/^[0-9]{3}$/', $int_test) == 0) {
        $error_php = '<span style="color: red;">半角英数字３桁で入力してください</span>';
    }
}
