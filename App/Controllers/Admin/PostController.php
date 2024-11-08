<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Post;

use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Post\Create;
use App\Views\Admin\Pages\Post\Edit;
use App\Views\Admin\Pages\Post\index;




class PostController
{


    // hiển thị danh sách
    public static function index()
    {

        $post = new Post();
        $data = $post->getAllPost();

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        index::render($data );
        Footer::render();
    }
}