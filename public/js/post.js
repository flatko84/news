

$(document).ready(function (e) {
    $('#post-form').on('submit', (function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#success').html("Success!");

                $('#success').show().delay(1500).fadeOut(500);
            },
            error: function (data) {
                console.log("error");
                console.log(data);
            }
        });
    }));


});