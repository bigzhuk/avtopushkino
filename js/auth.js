$(document).ready(function() {
    $('#login').on('click', function(){
        var username = $('#username').val();
        var password = $('#password').val();
        $.post("../modules/authorization.php", {
                username: username,
                password: password,
                button_click: 'login'
            },
            function(data) {

                 if(data=='1'){
                     location.reload();
                 }
                 else if(data=='0'){
                     $('span.error').text('Неверный логин пароль');
                 }


            });

    });

    $('#logout').on('click', function(){
        $.post("../modules/authorization.php", {
            button_click: 'logout'
            },
            function(data) {
            location.reload();
        });
    });
});
