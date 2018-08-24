<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ファイルアップロード</title>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<h4>ファイルアップロードのテスト</h4>
<form name="form1" method="post" action="view.php" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="100000">
    画像：
    <input type="file" name="uploadfile">
    <br>
    説明：
    <input type="text" name="comment">
    <br>
    <br>
    <input type="submit" value="ファイルアップロード">
</form>
</body>
</html>