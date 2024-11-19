<?php

namespace App\Controllers\Admin;



use App\Views\Admin\Pages\Auth\Login;

class AuthController
{

    public static function login()
    {
        Login::render();
    }
}
