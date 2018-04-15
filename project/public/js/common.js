$(function() {
    $('#address_search').click(function() {

        var zip1 = $('#zip1').val();
        var zip2 = $('#zip2').val();

        var rule1 = /[0-9]{3}/;
        var rule2 = /[0-9]{4}/;

        zip1 = escape(zip1);
        zip2 = escape(zip2);

        var file = "../member/postcode_search.php";
        file = file + "?zip1=" + zip1 + "&zip2=" + zip2;

        if (zip1.match(rule1) === null ||
            zip2.match(rule2) === null) {

            alert('正確に入力してください。');
            return false ;//ページ遷移をしない
        } else {
            $.ajax({
                type : "get" ,
                url  : file,
                //urlのプログラムでechoされたものがdata
                success : function (data) {
                    if(data == 'no' || data == '') {
                        alert( '該当する郵便番号がありません');
                    } else {
                        $('.pref').append(data);
                    }
                }
            });
        }
    });
});
