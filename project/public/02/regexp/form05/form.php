<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>入力検証</title>
    <script src="javascript.js"></script>
</head>
<body>
<form class="clear" name="form">
    <table>
        <tr>
            <td>名前</td>
            <td>
                <input type="text" id="family_name" value="氏">
                <input type="text" id="first_name" value="名">
            </td>
        </tr>
        <tr>
            <td>性別</td>
            <td>
                <input type="radio" name="gender" value="男" checked>
                男
                <input type="radio" name="gender" value="女">
                女
            </td>
        </tr>
        <script>
            var selectYear = document.getElementById("year");

            var year = new Date();
            var year = year.getFullYear();
        </script>
        <tr>
            <td>生年月日</td>
            <td>
                <select id="year">
                    <option value=""></option>
                    <script>
                        for(var i=1970; i <= year; i++){
                            document.write('<option value=' + i + '>' + i + '</option>');
                        }
                    </script>
                </select>
            </td>
        </tr>

        <tr><td>交通手段</td>
            <td>
                <input id="Checkbox1" name="traffic" type="checkbox" />徒歩
                <input id="Checkbox2" name="traffic" type="checkbox" />自転車
                <input id="Checkbox3" name="traffic"type="checkbox" />バス
                <input id="Checkbox4" name="traffic" type="checkbox" />電車
                <input id="Checkbox5" name="traffic" type="checkbox" />車・バイク
            </td>
        </tr>
    </table>
    <input type="button" id="submit" onclick="" value="送信">
</form>

<table class="empty_table" id="regist" border="1px">
</table>
</body>
</html>