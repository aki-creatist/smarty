window.onload = pageLoaded;
//ページロード時の処理
function pageLoaded(event)
{
    var elem = document.getElementById('btn_addprod'); // btn_addprodというIDを持つ要素を選択し
    elem.onclick = addProduct;  // そのonclickプロパティにaddProduct関数を代入
}

/**
 * イベントハンドラ
 * 呼び出された際に、addProduct関数にはイベントに関連する一つの引数が渡される
 * @param event
 */
function addProduct(event)
{
    var elem = document.getElementById('cart');
    elem.className = 'filled';
    elem.innerHTML += '<p>商品が入る</p>';
}
