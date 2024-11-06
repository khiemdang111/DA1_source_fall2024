<?php

namespace App\Controllers\Client;

use App\Views\Client\Pages\Auth\Login;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Helpers\AuthHelper;
use App\Validations\AuthValidation;
use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;


class AuthController
{
    public static function login()
    {
        Header::render();
        Notification::render();
        NotificationHelper::unset(); 
        Login::render();
        Footer::render();
    }


    public static function loginAction()
    {
        $is_valid = AuthValidation::login();
        if (!$is_valid) {
            NotificationHelper::error('login_valid', 'Đăng nhập thất bại');
            header('Location: /login');
            exit();
        }
        $data = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'remember' => isset($_POST['remember'])
        ];

        $result = AuthHelper::login($data);
        if ($result) {
            header('Location: /');
        } else {
            NotificationHelper::error('login', 'Đăng nhập thất bại');
            header('Location: /login');

        }


    }

   
}