<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Views\Client\Layouts\Header;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
class HomeController
{
    // hiển thị danh sách
    public static function index()
    {
        $category = new Category();
        $categories = $category->getAllCategoryByStatus();

        // lấy dữ liệu sản phẩm từ database
        $product = new Product();
        $products = $product->getAllProductByStatus();


        $data = [
            'products' => $products,
            'categories' => $categories
        ];
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Home::render($data);
        Footer::render();
    }

   
}
