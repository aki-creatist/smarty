window.addEventListener('load',
    function(event){
        var elem = document.getElementById('hobby');
        elem.addEventListener('keyup', onButtonClick, false);
    }
    ,false);

var errArr = [];

function onCheckBoxChange() {
    var check = document.getElementsByName('hobby');

    check = true;

    var target = document.getElementById('output');

    if (check == true ) {
        target.innerHTML = '';
    }
}

function onButtonClick() {
    check = document.getElementsByName('checkBox');

    target = document.getElementById("output");
    if (check == true) {
        target.innerHTML = "チェック項目1がチェックされています。<br/>";
    } else {
        target.innerHTML = "最低一つ選択してください。";
    }
}