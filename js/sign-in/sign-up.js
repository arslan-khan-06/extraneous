$('#form-1').submit((e) => {
    e.preventDefault();
    let name = $('#name-1').val();
    let name_length = name.length;
    // const name_format = /[^a-zA-Z0-9_]/g;

    let email = $('#email-1').val();
    let email_length = email.length;
    const email_format = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    let password_1 = $('#password-1').val();
    let password_1_length = password_1.length;

    let password_2 = $('#password-2').val();
    let password_2_length = password_2.length;

    if (name_length < 3 || name_length > 15) {
        alert("Name doesn't match the required length")
        $('#name-1').css('border', '1px solid red');
    } else if (!email_format.test(email) || email_length < 5) {
        alert('Invalid email address!')
    } else if (password_1_length < 6) {
        alert("Password doesn't match the required length");
        $('#password-1').css('border', '1px solid red');
    } else if (password_2 != password_1) {
        alert("Passwords don't match");
        $('#password-1').css('border', '1px solid red');
        $('#password-2').css('border', '1px solid red');
    } else {
        $('#load-id').css('display', 'flex');
        var data = $('#form-1').serialize();

        $.ajax({
            type: "POST",
            url: "../modules/server-1/sign-up-server",
            data: data,
            dataType: "html",
            success: function(request) {
                window.location.href = "verify";
                $('#load-id').css('display', 'none');
            },
        });
    }
})

$('body').keypress(() => {
    $('#name-1').css('border', '1px solid gray');
    $('#email-1').css('border', '1px solid gray');
    $('#password-1').css('border', '1px solid gray');
    $('#password-2').css('border', '1px solid gray');
});