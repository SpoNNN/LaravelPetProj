$(document).ready(function () {

    $('#anonymousCheck').change(function () {
        if ($(this).is(':checked')) {
            $('#name').slideUp(300, function () {
                $(this).prop('disabled', true);
            });
        } else {
            $('#name').prop('disabled', false).slideDown(300);
        }
    }).trigger('change');
});
$(document).ready(function () {

    $('#registerForm').submit(function (e) {
        e.preventDefault();

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');

        var formData = $(this).serialize();

        $.ajax({
            url: '/register',
            type: 'POST',
            data: formData,
            success: function (response) {

                window.location.href = '/';

            },
            error: function (res) {
                if (res.status === 400) {
                    var errors = res.responseJSON.errors;
                    $.each(errors, function (field, messages) {
                        var $input = $('input[name="' + field + '"]');
                        if ($input.length) {
                            $input.addClass('is-invalid');
                            var $errorElement = $('#' + field + 'Error');
                            if ($errorElement.length) {
                                $errorElement.text(messages[0]);
                            }
                        }
                    });
                }
            }
        });
    });
    $('#loginForm').submit(function (e) {

        e.preventDefault();

        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');

        var formData = $(this).serialize();

        $.ajax({
            url: '/login',
            type: 'POST',
            data: formData,
            success: function (response) {
                window.location.href = '/profile';
            },
            error: function (res) {
                if (res.status === 400) {
                    var errors = res.responseJSON.errors;
                    $.each(errors, function (field, messages) {
                        if (field === 'emailpassword') {
                            $('#email').addClass('is-invalid');
                            $('#password').addClass('is-invalid');
                            $('#emailpasswordError').text(messages[0]).removeClass('d-none');
                        }
                    });
                }
            }
        });
    });

});