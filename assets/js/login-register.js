/*
 *
 * login-register modal
 * Autor: Creative Tim
 * Web-autor: creative.tim
 * Web script: http://creative-tim.com
 * 
 */
function showRegisterForm() {
    $('.loginBox').fadeOut('fast', function () {
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast', function () {
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Register with');
    });
    $('.error').removeClass('alert alert-danger').html('');

}
function showLoginForm() {
    $('#loginModal .registerBox').fadeOut('fast', function () {
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast', function () {
            $('.login-footer').fadeIn('fast');
        });

        $('.modal-title').html('Login with');
    });
    $('.error').removeClass('alert alert-danger').html('');
}

function openLoginModal() {
    showLoginForm();
    setTimeout(function () {
        $('#loginModal').modal('show');
    }, 230);

}
function openRegisterModal() {
    showRegisterForm();
    setTimeout(function () {
        $('#loginModal').modal('show');
    }, 230);

}

function loginAjax() {
    var formData = $('#logInForm').serialize();
    var csrfHash = $(document).find('input[name="csrf_test_name"]').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'Home_controller/signin',
            data: {formData: formData, csrf_test_name: csrfHash},
            success: function (data) {
                var message = '';
                if (data) {
                    message = JSON.parse(data);
                    $(document).find('.txt_csrfname').val(message.token);
                }
                if (message && message.error == 0) {
                    document.location.href = message.redirect;
                } else {
                    shakeModal(); 
                    $(document).find('#error_msg').html(message.message);
                }
            }
        });
}
function registerAjax() {
    var formData = $('#signInForm').serialize();
    var csrfHash = $(document).find('input[name="csrf_test_name"]').val();
    var remail = $('#remail').val();
    var rpassword = $('#rpassword').val();
    var password_confirmation = $('#password_confirmation').val();
    if (!remail.length > 0 && !rpassword.length > 0 && !password_confirmation.length > 0) {
        $(document).find('#error_msg').removeClass('alert').html('<div class="alert alert-danger text-center" role="alert"><div class="alert-text">Fill all the field !</div></div>');
        shakeModal();
    } else {
        $.ajax({
            type: 'POST',
            url: base_url + 'Home_controller/signup',
            data: {formData: formData, csrf_test_name: csrfHash},
            success: function (data) {
                var message = '';
                if (data) {
                    message = JSON.parse(data);
                    $(document).find('.txt_csrfname').val(message.token);
                }
                if (message && message.suceess == 1) {
                    document.location.reload();
                } else {
                    shakeModal(); 
                    $(document).find('#error_msg').html(message.msg);
                }
            }
        });
    }
}

function shakeModal() {
    $('#loginModal .modal-dialog').addClass('shake');
//    $('.error').addClass('alert alert-danger').html("Invalid email/password combination");
    $('input[type="password"]').val('');
    setTimeout(function () {
        $('#loginModal .modal-dialog').removeClass('shake');
    }, 1000);
}

   