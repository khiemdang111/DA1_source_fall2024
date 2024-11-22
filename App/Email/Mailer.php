<?php

namespace App\Email;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
//  require 'vendor/autoload.php';

class Mailer
{
    public static function sendMail($email, $body)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
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
            //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('daothpc08990@gmail.com');
            $mail->addBCC('winecantho@gmail.com');
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Mã xác nhận quên mật khẩu ';
            $mail->Body = $body;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
   
}