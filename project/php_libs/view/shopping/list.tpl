<html>
<head>
    <meta charset="utf-8" />
    <link href="./css/shopping.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form method="post" action="" enctype="multipart/form-data">
    商品名:
    <input type="text" name="item_name" value="{$arr_form['name']}" />
    {$arr_err_msg["name"]}<br />
    価格:
    <input type="text" name="price" value="{$arr_form['price']}" size="11" maxlength="11"/>
    {$arr_err_msg["price"]}<br />
    画像:
    <input type="file" name="image"  />
    {$arr_err_msg["image"]}<br />
    <input type="submit" name="send"  value="送信" />
</form>
<div id="wrapper">
    {include file="category_menu.tpl"}
    <div id="item_list">
        {if $data !== false }
            {foreach from=$data item=value}
                <div class="item">
                    <ul>
                        <li class="name"><a href="./detail.php?item_id={$value.id}">{$value.name}</a></li>
                        <li class="price">&yen;{$value.price|number_format:0}</li>
                        <li class="image"><a href="./detail.php?item_id={$value.id}"><img src="images/{$value.image}" alt="{$value.name}" /></a></li>
                        <li class="detail"><a href="./detail.php?item_id={$value.id}">詳細</a></li>
                    </ul>
                </div>
            {/foreach}
        {else}
            <p>検索キーワードに合致する商品は存在しません。</p>
        {/if}
    </div>
</div>
</body>
</html>
