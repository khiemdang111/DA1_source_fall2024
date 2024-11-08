<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\User;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\User\Create;
use App\Views\Admin\Pages\User\Edit;
use App\Views\Admin\Pages\User\index;
use App\Validations\UserValidation;



class UserController
{


    // hiển thị danh sách
    public static function index()
    {

        $user = new User();
        $data = $user->getAllUser();

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        index::render($data );
        Footer::render();
    }
    

    public static function create()
    {
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Create::render();
        Footer::render();
    }


    public static function store()
    {
        $is_valid = UserValidation::create();
        if (!$is_valid) {

            NotificationHelper::error('store', 'Thêm khách hàng thất bại');
            header('location: /admin/users/create');
            exit();

        }
        $username = $_POST['username'];
        $user = new User();
        $is_exsite = $user->getOneUserByUsername($username);
        if ($is_exsite) {
            NotificationHelper::error('store', 'Tên loại người dùng đã tồn tại');
            header('location: /admin/users/create');
            exit();
        }

        $data = [
            'username' => $username,
            'email' => $_POST['email'],
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'status' => $_POST['status'],
            'role' => $_POST['role'],
        ];

        $is_upload = UserValidation::uploadAvatar();
        if ($is_upload) {
            $data['avatar'] = $is_upload;
        }
        // var_dump($data );
        // die;
        $result = $user->createUser($data);
        if ($result) {
            NotificationHelper::success('store', 'Thêm khách hàng thành công');
            header('location: /admin/users');
            exit();

        } else {
            NotificationHelper::error('store', 'Thêm khách hàng thất bại');
            header('location: /admin/users/create');
            exit();
        }
    }
}