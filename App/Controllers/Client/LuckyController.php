<?php

namespace App\Controllers\Client;

use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Lucky_spin\Luky_spin;

class LuckyController
{
    public static function index()
    {
        
        Header::render();
        Luky_spin::render();
        Footer::render();
    }
    
    
    
}

