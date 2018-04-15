{include file='../elements/header.tpl' page_title={$smarty.const.MY_TITLE}}

<center>
    <hr size="1" noshade>
    <b>{$title}</b>
    <hr size="1" noshade>
    <table width="100%" border="0" cellspacing="5" cellpadding="5">
        <tr>

            <td width="22%" align="left" valign="top">
                [ <a href="{$SCRIPT_NAME}">トップページへ</a> ]
            </td>
            <td width="78%" align="left" valign="top">
                {$message}
            </td>
        </tr>
    </table>
</center>
{if ($debug_str)}<PRE>{$debug_str}</PRE>{/if}

{include file='../elements/footer.tpl'}
