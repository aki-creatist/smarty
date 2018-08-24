<?php
$error_php = '';
$mail_test = isset($_POST['email']) === true ? $_POST['email'] : '';
if (isset($_POST["send"]) ===  true) {
    if (preg_match('/^[\w\-\.]+@[\w\-\.]+$/', $mail_test) == 0) {
        $error_php = '<span style="color: red;">正しい形式で入力して下さい</span>';
    }
}
