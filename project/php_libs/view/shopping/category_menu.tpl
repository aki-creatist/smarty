<div id="category">
    {if isset($login_id) === true}<p style="margin-left:25px;">こんにちは<br>{$login_id}さん</p>{/if}
    <form action="" method="post" name="search">
        <ul>
            {if isset($search_word) === true}
                <p><input type="text" name="search_word" value="{$search_word}" size="15"></p>
                <p><input type="submit" name="send" value="検索" size="10"></p>
            {/if}
            <li><a href="./list.php">全て</a></li>
            {foreach from=$categories item=value}
                <li><a href="./list.php?category_id={$value.id}">{$value.name}</a></li>
            {/foreach}
        </ul>
    </form>
</div>
