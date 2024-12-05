<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Vourcher;
use App\Validations\CategoryValidation;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Category\Create;
use App\Views\Admin\Pages\Category\Edit;
use App\Views\Admin\Pages\Vourcher\Index;
use App\Helpers\AuthHelper;

class VourcherController
{


    
    public static function index()
    {
      $vourcher = new Vourcher();
      $data = $vourcher->getAlldiscount_codesJoinUser();

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        // hiển thị giao diện danh sách
        Index::render($data);
        Footer::render();
    }


    // hiển thị giao diện form thêm
    public static function create()
    {
        AuthHelper::checkPermission([0, 4]);
        // var_dump($_SESSION);
        Header::render();
        // hiển thị form thêm
        Notification::render();
        NotificationHelper::unset();
        Create::render();
        Footer::render();
    }


   
    
}
