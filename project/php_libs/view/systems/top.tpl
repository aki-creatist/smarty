{include file='../elements/header.tpl' page_title={$smarty.const.MY_TITLE}}

<center>
    <hr size="1" noshade>
    <h1>{$title}</h1>
    <hr size="1" noshade>
    <p align="right" valign="top">
        {$disp_login_state}
        [ <a href="{$SCRIPT_NAME}?mode=logout" align="right">ログアウト</a> ]
    </p>

    <table width="100%" border="0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="left" valign="top">
                [ <a href="{$SCRIPT_NAME}">トップページへ</a> ]<br>
                [ <a href="{$SCRIPT_NAME}?mode=create&action=form{$add_pageID}">新規登録</a> ]<br>
                [ <a href="{$SCRIPT_NAME}?mode=list&action=form">会員一覧</a> ]
            </td>
        </tr>
    </table>
</center>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}

{include file='../elements/footer.tpl'}