{include file='../elements/header.tpl' page_title={$smarty.const.MY_TITLE}}

<form method="POST" action="">
    <table>
        <tr>
            <th>名前</th>
            <td>
                <input type="text" name="name" value={$posted_data.name}>
            </td>
        </tr>
        <tr>
            <th>コメント</th>
            <td>
                <textarea name="contents" rows="4" cols="20">{$posted_data.contents}</textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="send" value="{$btn}" />
                <input type="hidden" name="action" value="regist" />
            </td>
        </tr>
    </table>
</form>

<form method="POST" action="">
    名前：<input type="text" name="search_key" value="{$search_key}">
    <input type="submit" name="submit" value="検索する">
    <input type="hidden" name="mode" value="list">
    <input type="hidden" name="action" value="form">
</form>

{if $message neq ''}
    <p>{$message}</p>
{/if}
{if $err_msgs neq ''}
    <p style="color:#f00;">{$err_msgs.name}</p>
    <p style="color:#f00;">{$err_msgs.contents}</p>
{/if}

<p>検索結果は{$count}件です。</p>
{$links}

<table border="1px">
    <tr>
        <th>ID</th>
        <th>名前</th>
        <th>コメント</th>
        <th>作成日</th>
        <th>更新日</th>
        <th>更新</th>
        <th>削除</th>
    </tr>
    {foreach from=$data key=key item=item}
        <tr>
            <td>{$item.id}</td>
            <td>{$item.name|htmlspecialchars}</td>
            <td>{'/\n/'|preg_replace:'<br />':$item.contents}</td>
            <td>{$item.created_at}</td>
            <td>{$item.updated_at}</td>
            <td>
                [<a href="{$SCRIPT_NAME}?mode=modify&action=form&id={$item.id}{$add_pageID}">更新</a>]
            </td>
            <td>
                [<a href="{$SCRIPT_NAME}?mode=delete&action=complete&id={$item.id}{$add_pageID}">削除</a>]
            </td>
        </tr>
    {/foreach}
</table>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}

{include file='../elements/footer.tpl'}
