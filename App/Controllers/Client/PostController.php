<?php

namespace App\Controllers\Client;

use App\Models\User;
use App\Views\Client\Pages\Auth\Login;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Helpers\AuthHelper;
use App\Validations\AuthValidation;
use App\Helpers\NotificationHelper;
use App\Models\Post;

use App\Views\Client\Components\Notification;
use App\Views\Client\Pages\Post\Contact;
use App\Views\Client\Pages\Post\index;

use Google\Service\CloudSearch\EmailAddress;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PostController 
{
    public static function index()
    {
        $post = new Post();
        $data = $post->getAllPost();

        Header::render();
        Notification::render();
        NotificationHelper::unset(); 
        index::render($data);
        Footer::render();
    }

    public static function Contact(){
        Header::render();
        Notification::render();
        NotificationHelper::unset(); 
        Contact::render();
        Footer::render();
    }
    public static function PostContact(){
        ob_start();  
        $is_valid = AuthValidation::contactForm();
        if (!$is_valid) {
            NotificationHelper::error('contact_valid', 'Gửi liên hệ thất bại');
            header('Location: /contact');
            exit();
        }
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'message' => $_POST['message'],
        ];
        $phpEmail= EmailController::sendEmail( $data['message'], $data['email'], $data['name']);       
        NotificationHelper::success('contact_success', 'Gửi liên hệ thành công');
        header('Location: /');
        ob_end_flush();
        
        
    }
   
}