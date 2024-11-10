<?php

namespace App\Controllers\Client;

use App\Models\User;
use App\Views\Client\Pages\Auth\Login;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Helpers\AuthHelper;
use App\Validations\AuthValidation;
use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;
use App\Views\Client\Pages\Auth\Register;

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

    public static function Register() 
    {
            Header::render();
            Notification::render(); 
            NotificationHelper::unset();
            Register::render();
            Footer::render();
    }
    public static function registerAction()
    {
        $is_valid = AuthValidation::register();
        if (!$is_valid) {
            NotificationHelper::error('register_valid', 'Đăng ký thất bại');
            header('Location: /register');
            exit();
        }
        $data = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'name' => $_POST['name'],
            // 're_password' => $_POST['re_password'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'avatar' => $_POST['avatar'],
            'address' => $_POST['address']
        ];
        $user = new User();
        $result = $user->createUser($data);
        if ($result) {
            NotificationHelper::success('register_valid', 'Đăng ký thành công');
            header('Location: /login');

        }else {
            var_dump('Đăng ký thất bại');
        }
    }

   
}