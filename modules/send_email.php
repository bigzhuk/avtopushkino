<?php
require_once("../classes/SendMailSmtpClass.php");
$send_mail = new SendMailSmtpClass();

    $phone = $_POST['phone'];
    $user_name = $_POST['user_name'];
    $car_type = $_POST['car_type'];
    $wanted_date = $_POST['wanted_date'];
    $token = $_POST['mail_secret'];


$mailto = 'bigzhuk@ya.ru';
$subject = 'Заявка с  сайта avtopushkino.ru';
$message = 'Телефон: '.$phone.'<br>
            Имя: '.$user_name.'<br>
            Марка авто: '.$car_type.'<br>
            Дата: '.$wanted_date.'<br>';

$check_phone = preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', $phone);
if(!$check_phone) {
    echo 1; // неверный телефон
}
elseif($token != 'etyI67siujA') {
    echo 2; // неверный токен
    return;
}
else {
    if ($send_mail->send($mailto, $subject, $message)) {
        echo 3; // отправили
    } else if (mail($mailto, $subject, $message)) {
        echo 4; // отправили
    } else {
        echo 5; // не отправили
    }
}





