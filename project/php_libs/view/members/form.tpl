{include file='../elements/header.tpl' page_title={$smarty.const.MY_TITLE}}

<b>{$title}</b>
<form method="post" action="./index.php?mode={$mode}&action=confirm">
    <table>
        <tr>
            <th>ユーザネーム<br>
                メールアドレス<span class="red">*</span>
            </th>
            <td>
                <input type="text" name="username" id="username" value="{$posted_data.username}" />
                {if $err_msgs.username neq ''}<br />
                <span class="red">{$err_msgs.username}</span>
                {/if}
            </td>
        </tr>
        <tr>
            <th>パスワード<span class="red">*</span></th>
            <td>
                <input type="password" name="password" value="{$posted_data.password}" />
                {if $err_msgs.password neq ''}<br />
                <span class="red">{$err_msgs.password}</span>
                {/if}
            </td>
        </tr>

        <tr>
            <th>お名前(氏名)<span class="red">*</span></th>
            <td>
                <input type="text" name="last_name" value="{$posted_data.last_name}" />
                <input type="text" name="first_name"  value="{$posted_data.first_name}" />
                {if $err_msgs.last_name neq ''}<br />
                <span class="red">{$err_msgs.last_name}</span>
                {/if}
                {if $err_msgs.first_name neq ''}<br />
                <span class="red">{$err_msgs.first_name}</span>
                {/if}
            </td>
        </tr>
        <tr>
            <th>お名前(かな)</th>
            <td>
                <input type="text" name="last_name_kana" value="{$posted_data.last_name_kana}" />
                <input type="text" name="first_name_kana"  value="{$posted_data.first_name_kana}" />
            </td>
        </tr>
        <tr>
            <th>性別<span class="red">*</span></th>
            <td>
                {html_radios name="gender" options=$genders selected=$posted_data.gender }
                {if $err_msgs.gender neq ''}<br />
                <span class="red">{$err_msgs.gender}</span>
                {/if}
            </td>
        </tr>
        <tr>
            <th>生年月日<span class="red">*</span></th>
            <td>
                <select name="year" >
                    {html_options options=$date[0] selected=$posted_data['year'] }
                </select>
                <select name='month'>
                    {html_options options=$date[1] selected=$posted_data['month'] }
                </select>
                <select name='day'>
                    {html_options options=$date[2] selected=$posted_data['day'] }
                </select>
                {if $err_msgs.year neq ''}<br />
                <span class="red">{$err_msgs.year}</span>
                {/if}
                {if $err_msgs.month neq ''}<br />
                <span class="red">{$err_msgs.month}</span>
                {/if}
                {if $err_msgs.day neq ''}<br />
                <span class="red">{$err_msgs.day}</span>
                {/if}
            </td>
        </tr>
        <tr>
            <th>郵便番号<span class="red">*</span></th>
            <td>
                <input type="text" name="zip1" value="{$posted_data.zip1}" id="zip1" size="3" maxlength="3" /> -
                <input type="text" name="zip2" value="{$posted_data.zip2}" id="zip2" size="4" maxlength="4" />
                <input type="button" name="address_search" value="〒から住所を入力" id="address_search" />
                {if $err_msgs.zip1 neq ''}<br />
                <span class="red">{$err_msgs.zip1}</span>
                {/if}
                {if $err_msgs.zip2 neq ''}<br />
                <span class="red">{$err_msgs.zip2}</span>
                {/if}
            </td>
        </tr>
        <tr>
            <th>住所<span class="red">*</span></th>
            <td>
                <p class="pref"></p>
            </td>
        </tr>
        <tr>
            <th>番地(建物)</th>
            <td>
                <input type="text" name="address" value="{$posted_data.address}" id="address" size="40" />
                {if $err_msgs.address neq ''}<br />
                    <span class="red">{$err_msgs.address}</span>
                {/if}
            </td>
        </tr>
        <tr>
            <th>電話番号<span class="red">*</span></th>
            <td>
                <input type="text" name="tel1" value="{$posted_data.tel1}" size="6" maxlength="6" />-
                <input type="text" name="tel2" value="{$posted_data.tel2}" size="6" maxlength="6" />-
                <input type="text" name="tel3" value="{$posted_data.tel3}" size="6" maxlength="6" />
                {if $err_msgs.tel1 neq ''}<br />
                <span class="red">{$err_msgs.tel1}</span>
                {/if}
                {if $err_msgs.tel2 neq ''}<br />
                <span class="red">{$err_msgs.tel2}</span>
                {/if}
                {if $err_msgs.tel3 neq ''}<br />
                <span class="red">{$err_msgs.tel3}</span>
                {/if}
            </td>
        </tr>
         <tr>
            <th>交通手段<span class="red">*</span></th>
            <td>
            {html_checkboxes name=traffic options=$traffics checked=$posted_data.traffic }
            {if $err_msgs.traffic neq ''}<br />
            <span class="red">{$err_msgs.traffic}</span>
            {/if}
            </td>
        </tr>
        <tr>
            <th>備考</th>
            <td>
                <textarea name="contents" rows="4" cols="40">{$posted_data.contents}</textarea>
            </td>
        </tr>
        <tr>
            <td align="left">
                <input type="button" value="戻る" onClick="history.back(); return false;">
                <input type="button" value="クリア">
                <input type="submit" value="確認画面へ" name="submit">
            </td>
        </tr>
    </table>
</form>
{if ($debug_str)}<PRE>{$debug_str}</PRE>{/if}

{include file='../elements/footer.tpl'}