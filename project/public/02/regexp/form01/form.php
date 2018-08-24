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
<script src="jquery.js"></script>

<form id="form" method="post" action="">
    <label>名前</label>
    <input type="text"
           name="required_test"
           id="name"
           class="valid required"
           value="<?=$posted;?>"
    />
    <input type="submit" name="send" value="クリック" />
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
    <tr>
        <td>jquery</td>
        <td id="error_jquery"></td>
    </tr>
</table>
</body>
</html>
