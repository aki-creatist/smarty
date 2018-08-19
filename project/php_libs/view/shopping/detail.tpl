<html>
<head>
    <meta charset="utf-8" />
    <script type="text/javascript" src="./js/shopping.js"></script>
    <link href="./css/shopping.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
    <div id="item_detail">
        <div class="image">
            <img src="images/{$data.image}" alt="{$data.name}" />
        </div>
        <div class="detail">
            <dl>
                <dt>商品名</dt><dd>{$data.name}</dd>
                <dt>詳細</dt><dd>{$data.detail}</dd>
                <dt>価格</dt><dd>&yen;{$data.price|number_format:0}</dd>
            </dl>
        </div>
        <div class="cart_in">
            <input type="button" name="back" value="一覧へ戻る" onClick="history.back(); return false;" />
            <input type="button" name="cart_in" value="ショッピングカートへ入れる" onClick="cart_in( '{$data.id}' );" />
        </div>
    </div>
</div>
</body>
</html>
