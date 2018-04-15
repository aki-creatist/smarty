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
            <td width="22%" align="left" valign="top">
                [ <a href="{$SCRIPT_NAME}">トップページへ</a> ]<br>
                [ <a href="{$SCRIPT_NAME}?mode=create&action=form{$add_pageID}">新規登録</a> ]<br>
                [ <a href="{$SCRIPT_NAME}?mode=list&action=form">会員一覧</a> ]
            </td>
            <td width="78%" align="left" valign="top">
                <form method="POST" action="">
                    名前：<input type="text" name="search_key" value="{$search_key}">
                    <input type="submit" name="submit" value="検索する">
                    <input type="hidden" name="mode" value="list">
                    <input type="hidden" name="action" value="form">
                </form>

                <p>検索結果は{$count}件です。</p>

                <p>{$links}</p>
                {if ($data) neq '' }
                <table width="100%" border="1"  cellspacing="0" cellpadding="8">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>氏</th>
                            <th>名</th>
                            <th>生年月日</th>
                            <th>県名</th>
                            <th>登録日</th>
                            <th>更新日</th>
                            <th>更新</th>
                            <th>削除</th>
                        </tr>

                        {foreach item=item from=$data}
                        <tr>
                            <td align="center">
                                <a href="{$SCRIPT_NAME}?mode=detail&id={$item.id}">
                                    {$item.id}
                                </a>
                            </td>
                            <td>
                                {$item.last_name|escape:"html"}
                            </td>
                            <td>
                                {$item.first_name|escape:"html"}
                            </td>
                            <td align="center">
                                {$item.year}/{$item.month}/{$item.day}
                            </td>
                            <td align="center">
                                {$item.pref}
                            </td>
                            <td align="center">
                                {$item.created_at|date_format:"%Y年%m月%d日"}
                            </td>
                            <td align="center">
                                {$item.updated_at|date_format:"%Y年%m月%d日"}
                            </td>
                            <td align="center">
                                [<a href="{$SCRIPT_NAME}?mode=update&action=form&id={$item.id}{$add_pageID}">更新</a>]
                            </td>
                            <td align="center">
                                [<a href="{$SCRIPT_NAME}?mode=delete&action=confirm&id={$item.id}{$add_pageID}">削除</a>]
                            </td>
                        </tr>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
            {/if}
        </td>
    </tr>
</table>
</center>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}

{include file='../elements/footer.tpl'}