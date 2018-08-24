window.addEventListener('load',
    function(event){
        var elem = document.getElementById('name');
        elem.addEventListener('keyup', nameCheck, false);
    }
    ,false);

var errors = [];
function nameCheck(event)
{
    var str = document.getElementById('name').value;
    errors["name"] = document.getElementById('error_javascript');
    if (str !== "") {
        errors["name"].innerHTML = '';
    } else {
        errors["name"].innerHTML = '<span style="color:red">名前は必須入力です。</span>';
    }
}