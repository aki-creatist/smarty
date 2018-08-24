window.addEventListener('load',
    function(event){
        var elem = document.getElementById('family_name');
        elem.addEventListener('keyup', nameCheck, false);
        var elem = document.getElementById('first_name');
        elem.addEventListener('keyup', nameCheck, false);
    }
    ,false);

var errors = [];
function nameCheck(event)
{
    var str = document.getElementById('family_name').value;
    errors["family_name"] = document.getElementById('javascript_family_name');
    if (str !== ""){
        errors["family_name"].innerHTML = '';
    } else {
        errors["family_name"].innerHTML = 'お名前(氏)は必須入力です。';
    }

    var str2 = document.getElementById('first_name').value;
    errors["first_name"] = document.getElementById('javascript_first_name');
    if (str2 !== ""){
        errors["first_name"].innerHTML = '';
    } else {
        errors["first_name"].innerHTML = 'お名前(名)は必須入力です。';
    }
}