window.addEventListener('load',
    function(event) {
        var elem = document.getElementById('int');
        elem.addEventListener('keyup', intCheck, false);
    }
    ,false);

var errors = [];

function intCheck(event)
{
    var str = document.getElementById('int').value;
    var regexp = /^[0-9]{3}$/;
    errors["int_test"] = document.getElementById('error_javascript');
    if (regexp.test(str)) {
        errors["int_test"].innerHTML = '';
    } else {
        errors["int_test"].innerHTML = '<span style="color: red;">半角英数字３桁で入力してください</span>';
    }
}
