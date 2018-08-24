$(function() {
    var msgs;
    var setError = function(elem, msg) {
        msgs.push('<span style="color: red;">' + msg + '</span>');
        $(elem)
            .addClass('error_field')
            .after('<span class="error_mark">*</span>');
    };

    $('#form').submit(function(e) {
        msgs = [];
        $('.error_mark', this).remove();
        $('.valid', this)
            .removeClass('error_field')
            .filter('.regexp')
            .each(function() {
                var reg = new RegExp($(this).data('pattern'));
                if (!reg.test($(this).val())) {
                    setError(this,
                        $(this).prev('label').text() + 'で入力してください');
                }
            });
        if (msgs.length === 0) {
            $('#error_jquery').css('display', 'none');
        } else {
            $('#error_jquery')
                .css('display', 'block')
                .html(msgs.join(''));
            e.preventDefault();
        }
    });
});

