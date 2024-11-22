<?php

namespace App\Controllers\Client;

use App\Email\Mailer;
use App\Models\User;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

// use App\Models\Mailer
use App\Views\Client\Pages\Auth\Forgetpass;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Helpers\NotificationHelper;

use App\Views\Client\Components\Notification;

class EmailController
{
    public static function forgetpass()
    {
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Forgetpass::render();
        Footer::render();
    }

    public static function mail()
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
      
        if (!$username ) {
            echo "Vui lòng nhập đầy đủ thông tin.";
            return;
        }
        $userModel = new User();
        $user = $userModel->getOneUserByUsername($username);

        $id = $user['id'];
        $_SESSION['id'] = $id;

        $number = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $number2 = $number;
        $data = [
            'token' => $number2,
        ];  
        $result =  $userModel->update($id, $data);

        Mailer::sendMail($email, $number2);
        if ($result) {
            // NotificationHelper::error('checkout', 'Vui lòng đăng nhập hoặc thêm sản phẩm vào giỏ hàng để thanh toán');
            header('location: /Verification');
        }

        // Tạo mật khẩu mới và mã hóa
        // $newPassword = self::generateRandomNumber();
        // $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // // xác minh mã code 
        // $newPassword = self::generateRandomNumber();
        // $_SESSION['verification_code'] = $newPassword; // Lưu mã vào session
        // $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $userCode = $_POST['verification_code'] ?? '';
        //     $sessionCode = $_SESSION['verification_code'] ?? null;
        //     if (!$sessionCode || $userCode !== $sessionCode) {
        //         $error['fail'] = 'Mã xác nhận không hợp lệ!';
        //     } else {
        //         // Xóa mã khỏi session để tránh sử dụng lại
        //         unset($_SESSION['verification_code']);

        //         // Chuyển hướng hoặc xử lý tiếp
        //         header('Location: /resetPassword'); // Hoặc bất kỳ trang nào bạn muốn
        //         exit;
        //     }
        //     // Xử lý thời gian khi mã xác nhận hết hạn
        //     $_SESSION['verification_time'] = time();
        //     $validTime = 300; 
        //     if (time() - $_SESSION['verification_time'] > $validTime) {
        //         unset($_SESSION['verification_code'], $_SESSION['verification_time']);/-strong/-heart:>:o:-((:-h //         $error['fail'] = 'Mã xác nhận đã hết hạn!';
        //     }
        // }


        // // Gửi email khôi phục mật khẩu
        // $subject = "Khôi phục mật khẩu";
        // $body = "Mật khẩu mới của bạn là: <strong>$newPassword</strong>";

        // $emailSent = Mailer::sendMail($email, $subject, $body);
        // if ($emailSent) {
        //     //   echo "Đã gửi mail thành công.";
        //     header('Location: /Verification');
        //     exit();
        //     // Cập nhật mật khẩu mới
        //     $updateSuccess = $userModel->updatePasswordByUsername($username, $hashedPassword);
        //     if ($updateSuccess) {
        //         echo "Mật khẩu đã được cập nhật.";
        //     } else {
        //         echo "Không thể cập nhật mật khẩu. Vui lòng thử lại.";
        //     }
        // } else {
        //     echo "Đã xảy ra lỗi khi gửi email.";
        // }
    }

    public static function generateRandomNumber()
    {
        return str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    }
    public static function sendEmail($message, $to, $name , $phone )
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
    public static function sendEmailAdmin($message, $to, $name,  $phone )
    {
        $mail = new PHPMailer();
        $cc= 'winecantho@gmail.com';

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
            $mail->addAddress($cc);
            $mail->addReplyTo('winecantho@gmail.com', 'WineCanTho');

                $mail->isHTML(true);
                $mail->Subject = 'thu phan hoi cua WinCanTho';
                $mail->Body    = " <p>Thông báo liên hệ,</p>
                <p>Gmail người liên hệ: $to,</p>
                <p>Số điện thoại:$phone </p>
                <p>Nội Dung liên hệ:<em>$message</em></p>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (\Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        return true;
    }
  }