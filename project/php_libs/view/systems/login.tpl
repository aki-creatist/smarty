{include file='../elements/header.tpl' page_title={$smarty.const.MY_TITLE}}

<center>
    <hr size="1" noshade>
    <b>{$title}</b>
    <hr size="1" noshade>
    <table width="100%" border="0" cellspacing="5" cellpadding="5">
        <tr>
            <td width="22%">
                <form method="POST" action="./index.php">
                    <table border="0" cellpadding="0" cellspacing="0" summary="login form" width="100">
                        <tr>
                            <td colspan="2" bgcolor="#eeeeee">
                                <b><font size="2">管理画面:</font></b>
                            </td>
                        </tr>
                        <tr>
                            <td nowrap>
                                <font size="2">ユーザー名:</font>
                            </td>
                            <td>
                                <input type="text" name="username">
                            </td>
                        </tr>
                        <tr>
                            <td nowrap>
                                <font size="2">パスワード:</font>
                            </td>
                            <td>
                                <input type="password" name="password">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" >
                                <input type="hidden" name="mode" value="{$mode}">
                                <div align="center">
                                    <input type="submit" name="submit" value="ログイン">
                                </div>
                                <br>
                                <font size="2" color="red">
                                    {$auth_error_mess}
                                </font>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
            <td width="78%" align="left" valign="top">
                <br>
                <br>
            </td>
        </tr>
    </table>
</center>
{if ($debug_str)}<PRE>{$debug_str}</PRE>{/if}

{include file='../elements/footer.tpl'}