<?php

namespace App\Controllers\Client;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class MailController
{
    public static function index($form)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        if (isset($_SESSION['user'])) {
            $email = $_SESSION['user']['email'];
        }
        if (isset($_COOKIE['user'])) {
            $user_COOKIE = json_decode($_COOKIE['user'], true);
            $email = $user_COOKIE['email'];
        }
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Hoặc máy chủ SMTP bạn sử dụng
            $mail->SMTPAuth = true;
            $mail->Username = 'winecantho@gmail.com'; // Email của bạn
            $mail->Password = 'cgzl wpri xtww nygw'; // Mật khẩu ứng dụng (nếu dùng Gmail)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS (587) hoặc SSL (465)
            $mail->Port = 587; // 587 (TLS) hoặc 465 (SSL)                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('winecantho@gmail.com', 'Wine CanTho');
            // $mail->addAddress('vubaokhanh2311@gmail.com', 'Khanh'); 
            // //Add a recipient
            // $mail->addAddress('dangkhiemct111@gmail.com', 'Quốc khiêm');     //Add a recipient
            // $mail->addAddress('loc2005care@gmail.com', 'Lộc');     //Add a recipient
            $mail->addAddress($email);
           
            $mail->addCC('daothpc08990@gmail.com');
            $mail->addBCC('winecantho@gmail.com');
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Cảm ơn bạn đã đặt hàng';
            $mail->Body = $form;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
       

}
