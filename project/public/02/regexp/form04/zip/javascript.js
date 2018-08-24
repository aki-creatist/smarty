window.addEventListener('load',
    function(event){
        var elem = document.getElementById('zip1');
        elem.addEventListener('keyup', zipCheck, false);
        var elem = document.getElementById('zip2');
        elem.addEventListener('keyup', zipCheck, false);
    }
    ,false);

var errors = [];
//郵便番号のチェック
function zipCheck(event)
{
    var str = document.getElementById('zip1').value;
    var regexp = /^[0-9]{3}$/;

    // zip1
    errors["zip1"] = document.getElementById('errors_zip1');
    if (regexp.test(str)) {
        errors["zip1"].innerHTML = '';
    } else {
        errors["zip1"].innerHTML = '半角英数字３桁で入力してください';
    }
    // zip2
    var str = document.getElementById('zip2').value;
    var regexp = /^[0-9]{4}$/;
    errors["zip2"] = document.getElementById('errors_zip2');
    if (regexp.test(str)){
        errors["zip2"].innerHTML = '';
    } else {
        errors["zip2"].innerHTML = '半角英数字４桁で入力してください';
    }
}
