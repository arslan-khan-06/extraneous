$('#form-1').submit((e) => {
    e.preventDefault();
    let password_1 = $('#password-1').val();
    let pass_1_len = password_1.length;

    let password_2 = $('#password-2').val();
    let pass_2_len = password_2.length;

    if (pass_1_len < 6) {
        alert('Password is too short');
        $('#password-1').css('border', '1px solid red');
    } else if (password_1 != password_2) {
        alert("Passwords don't match!");
        $('#password-1').css('border', '1px solid red');
        $('#password-2').css('border', '1px solid red');
    } else {
        $('#password-1').css('border', '1px solid gray');
        $('#password-2').css('border', '1px solid gray');
        
        $('#load-id').css('display', 'flex');
        var data = $('#form-1').serialize();

        $.ajax({
            type: "POST",
            url: "../modules/server-1/reset-server",
            data: data,
            dataType: "html",
            success: function (req) {
                alert('Password has been changed successfully. You will be redirected to login.');
                window.location.href = "login";
                $('#load-id').css('display', 'none');
            }
        });

    }
})



$('body').keypress(() => {
    $('#password-1').css('border', '1px solid gray');
    $('#password-2').css('border', '1px solid gray');
});