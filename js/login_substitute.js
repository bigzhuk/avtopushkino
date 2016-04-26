$(document).ready(function() {
    $('#username').on('focus', function(){
        if ($(this).val() == 'Логин'){
            $(this).val('');
        }
    })

    $('#username').on('blur', function(){
    if ($(this).val() == 'Логин' || $(this).val() == ''){
    $(this).val('Логин');
    }
    })

    $('#password').on('focus', function(){
    if ($(this).val() == 'Пароль'){
    $(this).val('');
    }
    })

    $('#password').on('blur', function(){
    if ($(this).val() == 'Пароль' || $(this).val() == ''){
    $(this).val('Пароль');
    }
    })
    });
