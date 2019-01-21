$(document).ready(function () {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#send-post').click(function () {

        $.ajax({
            url: '/post/' + $('#post-id').val(),
            type: 'put',
            data: $('#post-form').serialize(),
            dataType: 'json',
            beforeSend: function () {
                $('#send-post').attr('disabled', true);
                $('.error').html('');
            },
            complete: function () {
                $('#send-post').attr('disabled', false);
            },
            success: function (json) {

                alert("Success!");
            }
            ,
            error: function (error) {

                var errors = error.responseJSON.errors;
                $.each(errors, function (key, element) {
                    $("#" + key + "-error").html(element);

                });
            }
        });
    });
}
);