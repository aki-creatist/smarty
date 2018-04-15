{include file='../elements/header.tpl' page_title={$smarty.const.MY_TITLE}}

<b>{$title}</b>
<p>{if $message neq ''}{$message}{/if}</p>
<form method="POST" action="">
    <table>
        <tr>
            <th>
                ユーザネーム<br>
                メールアドレス
            </th>
            <td>
                {$posted_data.username}
            </td>
        </tr>
        <tr>
            <th>パスワード</th>
            <td>
                {$posted_data.password}
            </td>
        </tr>
        <tr>
            <th>お名前(氏名)</th>
            <td>
                {$posted_data.last_name} {$posted_data.first_name}
            </td>
        </tr>
        <tr>
            <th>お名前(かな)</th>
            <td>{$posted_data.last_name_kana} {$posted_data.first_name_kana}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>
                {if $posted_data.gender eq '0'}
                男性
                {elseif $posted_data.gender eq '1'}
                女性
                {/if}
            </td>
        </tr>
        <tr>
            <th>生年月日</th>
            <td>
                {$posted_data.year}年 {$posted_data.month}年 {$posted_data.day}日
            </td>
        </tr>
        <tr>
            <th>郵便番号</th>
            <td>
                {$posted_data.zip1} - {$posted_data.zip2}
            </td>
        </tr>
        <tr>
            <th>住所</th>
            <td>
                {$posted_data.address}
            </td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>
                {$posted_data.tel1} - {$posted_data.tel2} - {$posted_data.tel3}
            </td>
        </tr>
        <tr>
            <th>交通手段</th>
            <td>
                {if "1"|in_array:$posted_data.traffic}徒歩{/if}
                {if "2"|in_array:$posted_data.traffic}自転車{/if}
                {if "3"|in_array:$posted_data.traffic}バス{/if}
                {if "4"|in_array:$posted_data.traffic}電車{/if}
                {if "5"|in_array:$posted_data.traffic}車・バイク{/if}
            </td>
        </tr>
        <tr>
            <th>備考</th>
            <td>{$posted_data.contents}</td>
        </tr>
        <td align="left">
            <input type="button" value="戻る" onClick="history.back(); return false;">
            {if $btn neq ''}
            <input type="submit" value="{$btn}" name="submit">
            {/if}
            <input type="hidden" name="mode"   value="{$mode}">
            <input type="hidden" name="action" value="{$action}">
        </td>
    </table>
    <div>
        {foreach from=$posted_data item=value key=key}
            {if is_array($value)}
                {foreach from= $value item=v }
                <input type="hidden" name="{$key}[]" value="{$v}" />
                {/foreach}
            {else}
                <input type="hidden" name="{$key}" value="{$value}" />
            {/if}
        {/foreach}
    </div>
</form>
{if ($debug_str)}<PRE>{$debug_str}</PRE>{/if}

{include file='../elements/footer.tpl'}