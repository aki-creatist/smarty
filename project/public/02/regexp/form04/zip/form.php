<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <title>入力検証</title>
</head>
<body>
<?php require_once './php.php'; ?>
<script src="javascript.js"></script>

<form method="post" action="">
    <label>Eメール</label>
    <input type="text" value="" name="zip1" id="zip1" size="3" maxlength="3" /> -
    <input type="text" value="" name="zip2" id="zip2" size="4" maxlength="4" />
    <input type="submit" name="send" value="送信" />
</form>

<table border="1px">
    <tr>
        <th>言語</th>
        <th>エラーメッセージの表示</th>
    </tr>
    <tr>
        <td>PHP</td>
        <td><?=$errors['zip1'];?></td>
    </tr>
    <tr>
        <td>PHP</td>
        <td><?=$errors['zip2'];?></td>
    </tr>
    <tr>
        <td>javascript</td>
        <td id="errors_zip1"></td>
    </tr>
    <tr>
        <td>javascript</td>
        <td id="errors_zip2"></td>
    </tr>
</table>
</body>
</html>
