$(function() {
    $('#username').change(function() {
        var username = $('#username').val();
        var file = "../member/check_username.php";
        file = file + "?username=" + username;

        if (username !== "") {
            $.ajax({
                type : "get",
                url  : file,
                success : function (data) {
                    if (data == 'no' || data == '') {
                        //
                    } else {
                        alertMessage();
                    }
                }
            });
        }
    });
});
function alertMessage() {
    alert('このユーザ名は登録されてます');
}
