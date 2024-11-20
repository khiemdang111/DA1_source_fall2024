<?php

namespace App\Controllers\Client;

use App\Email\Mailer;
use App\Models\User;
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
        $username = $_POST['username'] ?? null;
        $email = $_POST['email'] ?? null;
      
        if (!$username ) {
            echo "Vui lòng nhập đầy đủ thông tin.";
            return;
        }
        $userModel = new User();
        $user = $userModel->getOneUserByUsername($username);
        // var_dump($user['id']);
        // die;
        $id = $user['id'];
        $_SESSION['id'] =$id;
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
  }