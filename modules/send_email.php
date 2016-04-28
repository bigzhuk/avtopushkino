<?php
require_once("../libs/PHPMailer-master/PHPMailerAutoload.php");


if($_POST['button_click'] == 'send_access_to_user') {

    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if(!empty($login) && !empty($password) && !empty($email)) {
        $mail = new PHPMailer;
        $mail->From = 'robot@avtopushkino.ru';
        $mail->FromName = 'Робот';
        $mail->addAddress($email, '');

        $mail->WordWrap = 50;

        $mail->isHTML(true);                                    // Set email format to HTML

        $mail->Subject = 'Доступ к системе онлайн отслеживание грузов vl-tl.ru';
        $mail->Body    = 'Добрый день. Для доступа к системе используйте, пожалуйста, следующие данные:<br/>'.
                         '<strong>Логин:</strong> '. $login.'<br/>'.
                         '<strong>Пароль:</strong> '.$password;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo '1'; // сообщение отправлено
        }
    }
}
else{
    $user_email = $_POST['email'];
    $user_phone = $_POST['phone'];
    $city_from = $_POST['city_from']." ".$_POST['street_from'];
    $city_to = $_POST['city_to']." ".$_POST['street_to'];

    if(!empty($user_email) && !empty($city_from) && !empty($city_to)) {
        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                                 // Enable verbose debug output

        //$mail->isSMTP();                                      // Set mailer to use SMTP
        //$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
        //$mail->SMTPAuth = true;                               // Enable SMTP authentication
        //$mail->Username = 'bigzhuk@ya.ru';                    // SMTP username
        //$mail->Password = 'secret';                           // SMTP password
        //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        //$mail->Port = 587;                                    // TCP port to connect to

        $mail->From = 'robot@avtopushkino.ru';
        $mail->FromName = 'Робот';
        $mail->addAddress('avtopushkino@mail.ru', '');                 // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        $mail->WordWrap = 50;                                   // Set word wrap to 50 characters
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                    // Set email format to HTML

        $mail->Subject = 'Заявка с сайта avtopushkino.ru';
        $mail->Body    = 'Заявка от клиента на перевоз груза:<br/>'.
                         'Пункт отправления: '.$city_from.'<br/>'.
                         'Пункт назначения: '.$city_to.'<br/>'.
                         'Тел. клиента: '.$user_phone.'<br/>'.
                         'E-mail клиента: '.$user_email.'<br/>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo '1'; // сообщение отправлено
        }
    }
}


