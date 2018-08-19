<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
</head>
<body>
    <p>１=よく当てはまる ２=あてはまる ３=あまりあてはまらない ４=あてはまらない</p>
    <br>
    <form method="post" action="">
    <table border="1">
        <tr>
            <th>&nbsp;</th>
            <th>１　２　３　４</th>
        </tr>
        {foreach from=$arr_question key=no item=value}
        <tr>
            <td>{$value.question}</td>
            <td>{html_radios name=$value.no options=$arr_question_index selected=$arr_param[$value.no]}  
                {if isset($arr_err[$value.no]) === true}<p style="color:red;">{$arr_err[$value.no]}</p>{/if}
            </td>
        </tr>
        {/foreach}
    </table>
    <br>
    <input type="submit" name="send" value="点数を計算して、タイプを決定します" />
    </form>
    {if empty($my_type) === false}<p>貴方は<span style="font-weight:bold;">{$my_type}</span>です<p>{/if}
</body>
</html>
