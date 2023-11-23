function loginUser() {
    var username = $('#username').val();
    var password = $('#password').val();

    $.ajax({
        type: 'POST',
        url: 'php/login.php',
        data: {username: username, password: password},
        success: function(response) {
            if (response === 'Login successful!') {
                window.location.href = 'profile.html';
            } else {
                alert(response);
            }
        }
    });
}
