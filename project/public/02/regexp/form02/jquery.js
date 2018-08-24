$(function() {
    var msgs;
    var setError = function(elem, msg) {
        msgs.push(msg);
        $(elem)
            .addClass('error_field')
            .after('<span class="error_mark">*</span>');
    };

    $('#form').submit(function(e) {
        msgs = [];
        $('.error_mark', this).remove();
        $('.valid', this)
            .removeClass('error_field')
            .filter('.required')
            .each(function() {
                if ($(this).val() === '') {
                    setError(this,
                        $(this).prev('label').text() + 'は必須入力です。');
                }
            })

        if (msgs.length === 0) {
            $('.jquery_error').css('display', 'none');
        } else {
            $('.jquery_error')
                .css('display', 'block')
                .html(msgs.join(' '));
            e.preventDefault();
        }
    });
});