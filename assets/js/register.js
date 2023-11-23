function registerUser() {
    var username = $('#username').val();
    var password = $('#password').val();

    $.ajax({
        type: 'POST',
        url: 'php/register.php',
        data: {username: username, password: password},
        success: function(response) {
            alert(response);
            window.location.href = 'login.html';
        }
    });
}