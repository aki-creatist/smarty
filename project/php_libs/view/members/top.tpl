{include file='../elements/header.tpl' page_title={$smarty.const.MY_TITLE}}

<center>
    <hr size="1" noshade>
    <b>{$title}</b>
    <hr size="1" noshade>
    <table width="100%" border="0" cellspacing="5" cellpadding="5">
        <tr>
            <td width="22%" align="left" valign="top">
          	[ <a href="{$SCRIPT_NAME}?mode=logout">ログアウト</a> ]
        	<br>
        	<br>
        	{$disp_login_state}
            </td>
            <td width="78%" align="left" valign="top">
                <p>
                    {$last_name|escape:"html"} {$first_name|escape:"html"} さん、こんにちは！
                    <br>
                    <br>
                    <a href="{$SCRIPT_NAME}?mode=update&action=form">会員登録情報の修正</a>
                    <br>
                    <br>
                    <a href="{$SCRIPT_NAME}?mode=delete&action=confirm">退会する</a>
                    <br>
                </p>
            </td>
        </tr>
    </table>
</center>
{if ($debug_str)}<PRE>{$debug_str}</PRE>{/if}

{include file='../elements/footer.tpl'}