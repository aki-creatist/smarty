window.addEventListener('load',
    function(event){
        var elem = document.getElementById('gender1');
        elem.addEventListener('focus', checkSelectRadio, false);
    }
    ,false);

var errArr = [];

function onRadioButtonChange() {
    var check = document.getElementsByName('gender');
    for (i = 0; i < check.length; i++) {
        if (check[i].checked) {
            check = true;
            break;
        }
    }

    var target = document.getElementById('output_gender');

    if (check == true ) {
        target.innerHTML = '';
    }
}

function checkSelectRadio()
{
    var check1 = "";
    if (check1 == false) {
        var selected_flg = false;
    }
    var elm = document.getElementsByName('gender');
    for (i = 0; i < elm.length; i++) {
        if (elm[i].checked) {
            selected_flg = true;
            break;
        }
    }
    output = document.getElementById('output_gender');
    if (selected_flg == false) {
        output.innerHTML = '性別を選択してください';
    }
}