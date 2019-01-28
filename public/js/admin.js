

function toggleAdmin(user_id) {
//alert($('#user-' + user_id).is(":checked"));
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var ch = ($('#user-' + user_id).is(":checked") === true) ? 1 : 0;
    $.ajax({
        url: '/admin/' + user_id,
        type: 'post',
        data: {_token: CSRF_TOKEN, admin: ch},
        dataType: 'json',
        beforeSend: function () {

            $('.error').html('');
        },
        complete: function () {
            $('#send-post').attr('disabled', false);
        },
        success: function (json) {


            $('#success').html("Success!");

            $('#success').show().delay(1500).fadeOut(500);

        }
        ,
        error: function (error) {
            var errors = error.responseJSON.errors;
            $.each(errors, function (key, element) {
                $("#" + key + "-error").html(element);

            });
        }
    });
}
