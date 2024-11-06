<?php
namespace App\Helpers;

use App\Models\User;


class AuthHelper
{
    public static function login($data)
    {
        $user = new User();
        $is_exist = $user->getOneUserByUsername($data['username']);

        if (!$is_exist) {
            NotificationHelper::error('username', 'Tên đăng nhập không tồn tại');
            return false;
        }
        if (!password_verify($data['password'], $is_exist['password'])) {
            NotificationHelper::error('password', 'Mật khẩu không đúng');
            return false;
        }
        if ($is_exist['status'] === 0) {
            NotificationHelper::error('status', 'Tài khoản đã bị khoá');
            return false;
        }

        if ($data['remember']) {
            self::updateCookie($is_exist['id']);
        } else {

            self::updateSession($is_exist['id']);
        }
        return true;

    }

    public static function updateCookie(int $id)
    {
        ob_start();
        $user = new User();
        $return = $user->getOneUser($id);

        if ($return) {
            $user_data = json_encode($return);
            setcookie("user", $user_data, time() + (86400 * 30), "/");
            $_SESSION['user'] = $return;
        }


    }


    public static function updateSession(int $id)
    {
        $user = new User();
        $return = $user->getOneUser($id);
    
        if ($return) {
            
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user'] = (array) $return;
        }
    }
    

    public static function checkLogin(): bool
    {
        if (isset($_COOKIE['user']) && !empty($_COOKIE['user'])) {
            $user = $_COOKIE['user'];
            
            $user_data = json_decode($user, true);
            
            if (is_array($user_data) && isset($user_data['id'])) {
              
                self::updateCookie($user_data['id']);
                $_SESSION['user'] = $user_data;
                return true;
            }
        }
    
        if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
          
            self::updateSession($_SESSION['user']['id']);
            return true;
        }
        return false;
    }
    
}
