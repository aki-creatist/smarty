$(function() {

    $("#sendButton").click(function() {

        //値の初期化
        init();

        //textのエラーチェック
        error_check = true;
        var name = $('#name_id').val();
        if (name ==='') {
            error_check = false;
            $('#name_id').css("background-color","#FFC0CB");
        }

        var age = $('#age_id').val();
        if (age  ==='') {
            error_check = false;
            $('#age_id').css("background-color","#FFC0CB");
        }

        //radioのエラーチェック
        var man = $('#man_id:checked').val();
        var woman = $('#woman_id:checked').val();
    
        //両方値が無ければエラー
        if (man === undefined && woman === undefined) {
            error_check = false;
            $("#sex_area").css("background-color","#FFC0CB");
        }

        //selectのエラーチェック
        var language = $("#language_id").val();
        if (language === '') {
            error_check = false;
            $('#language_id').css("background-color","#FFC0CB");
        }

        if (error_check === true) {
            document.forms[0].submit();
        }
    });

    //色の初期化
    function init()
    {
        $('input[type=text],input[type=file]').css("background-color", "");
        $('#sex_area').css('background-color', '');
        $("select").css('background-color', '');
    }
});
