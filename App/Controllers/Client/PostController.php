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
use App\Views\Client\Pages\Post\index;

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
    
}