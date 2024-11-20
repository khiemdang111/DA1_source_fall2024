<?php

namespace App\Controllers\Client;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
class EmailController
{
    public static function sendEmail($message, $to, $name)
    {
        $mail = new PHPMailer();

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'winecantho@gmail.com';
            $mail->Password   = 'cgzl wpri xtww nygw';
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
            $mail->SMTPSecure = 'tls';
            $mail->Port       = '587';

            //Recipients
            $mail->setFrom('winecantho@gmail.com', 'WineCanTho');
            $mail->addAddress($to, $name);
            $mail->addReplyTo('winecantho@gmail.com', 'WineCanTho');

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'thu phan hoi cua WinCanTho';
            $mail->Body    = " <p>Kính gửi <strong>$name</strong>,</p>
            <p>Cảm ơn quý vị đã gửi thư và thông tin phản hồi. Tôi rất trân trọng sự quan tâm và đóng góp của quý vị. Những ý kiến của quý vị sẽ giúp chúng tôi cải thiện và nâng cao chất lượng dịch vụ hơn nữa.</p>
            <p>Về vấn đề mà quý vị đã nêu ra, chúng tôi xin chân thành xin lỗi về sự bất tiện đã gây ra. Chúng tôi đã xem xét và sẽ có những điều chỉnh cần thiết để đảm bảo tình trạng tương tự không xảy ra trong tương lai.</p>
            <p>Chúng tôi luôn mong muốn mang lại sự hài lòng tuyệt đối cho khách hàng, và phản hồi của quý vị là yếu tố quan trọng giúp chúng tôi phát triển.</p>
            <p>Nếu có bất kỳ câu hỏi hoặc yêu cầu nào khác, xin đừng ngần ngại liên hệ lại với chúng tôi. Chúng tôi rất mong có cơ hội tiếp tục phục vụ quý vị trong tương lai.</p>
            <p>Chân thành cảm ơn sự hợp tác và hỗ trợ của quý vị.</p>
            <p>Trân trọng,</p>
            <p>WineCanTho</p>";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (\Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        return true;
    }
}
