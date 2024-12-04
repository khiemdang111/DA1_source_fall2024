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
use App\Views\Client\Pages\Post\Blog_single;
use App\Views\Client\Pages\Post\Contact;
use App\Views\Client\Pages\Aboutl\index;

use Google\Service\CloudSearch\EmailAddress;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class AboutlController 
{
    public static function index()
    {
       

        Header::render();
        Notification::render();
        NotificationHelper::unset(); 
        index::render();
        Footer::render();
    }

   
}