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
    <input type="text" name="email" id="email" value="">
    <input type="submit" name="send" value="送信" />
</form>

<table border="1px">
    <tr>
        <th>言語</th>
        <th>エラーメッセージの表示</th>
    </tr>
    <tr>
        <td>PHP</td>
        <td><?=$error_php;?></td>
    </tr>
    <tr>
        <td>javascript</td>
        <td id="error_javascript"></td>
    </tr>
</table>
</body>
</html>
