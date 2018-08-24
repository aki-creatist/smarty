window.addEventListener('load',
    function(event) {
        var elem = document.getElementById('year');
        elem.addEventListener('focus', checkSelectPulldown, false);
    }
    ,false);

var errors = [];

function onPulldownChange()
{
    var check = document.getElementsByName('year');
    check = true;
    var target = document.getElementById('output_year');
    if (check == true ) {
        target.innerHTML = '';
    }
}

function checkSelectPulldown()
{
    var check1 = "";
    if (check1 == false) {
        var selected_flg = false;
    }
    var elm = document.getElementsByName('year');
    for (i = 0; i < elm.length; i++) {
        if (elm[i].checked) {
            selected_flg = true;
            break;
        }
    }
    output = document.getElementById('output_year');
    if (selected_flg == false) {
        output.innerHTML = '年を選択してください';
    }
}