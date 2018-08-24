window.addEventListener('load',
    function(event){
        elem = document.getElementById('email');
        elem.addEventListener('keyup', validMail, false);
    }
    ,false);
//メールチェック
function validMail(event){
    var str = document.getElementById('email').value;
    var regexp = /^[\w\-\.]+@[\w\-\.]+$/
    var output = document.getElementById('error_javascript');
    if(regexp.test(str)){
        output.innerHTML = '';
    } else {
        output.innerHTML = '<span style="color: red;">正しい形式で入力して下さい</span>';
    }
}
