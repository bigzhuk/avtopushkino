<?php
require_once("../classes/SendMailSmtpClass.php");
$send_mail = new SendMailSmtpClass();

    $phone = $_POST['phone'];
$phone =123;
    $user_name = $_POST['user_name'];
    $car_type = $_POST['car_type'];
    $wanted_date = $_POST['wanted_date'];

    if(!empty($phone)) {
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
        $mail->addAddress('bigzhuk@ya.ru');
        //$mail->addAddress('avtopushkino@mail.ru', '');                 // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        $mail->WordWrap = 50;                                   // Set word wrap to 50 characters
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                    // Set email format to HTML

        $mail->Subject = 'Заявка с сайта avtopushkino.ru';
        $mail->Body    = 'Заявка от клиента на онлайн запись:<br/>'.
                         'Телефон: '.$phone.'<br/>'.
                         'Имя клиента: '.$user_name.'<br/>'.
                         'Марка авто: '.$car_type.'<br/>'.
                         'Желаемая дата: '.$wanted_date.'<br/>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo '1'; // сообщение отправлено
        }

}


