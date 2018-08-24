<?php

$next_year = date('Y') + 1;

// 年を作成
for ($i = 2010; $i < $next_year; $i++) {
    $year = sprintf("%04d", $i);
    $years[$year] = $year;
}

// 月を作成
for ($i = 1; $i < 13 ; $i++) {
    $month = sprintf("%02d", $i);
    $months[$month] = $month;
}

// 日を作成
for ($i = 1; $i <32; $i++) {
    $day = sprintf("%02d", $i);
    $days[$day] = $day;
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>会員登録</title>
</head>
<body>
<table>
    <tr>
        <th>生年月日<span class="red">*</span></th>
        <td>
            <select name="year" >
                <option selected></option>
                <?php foreach ($years as $year) { ?>
                    <option value="<?=$year?>"><?=$year?></option>
                <?php } ?>
            </select>年

            <select name='month'>
                <option selected></option>
                <?php foreach ($months as $month) { ?>
                    <option value="<?=$month?>" ><?=$month?></option>
                <?php } ?>
            </select>月

            <select name='day'>
                <option selected></option>
                <?php foreach ($days as $day){ ?>
                    <option value="<?=$day?>" ><?=$day?></option>
                <?php } ?>
            </select>日
        </td>
    </tr>
</table>
</body>
</html>