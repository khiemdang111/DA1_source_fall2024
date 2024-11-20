<?php

namespace App\Controllers\Client;

use App\Helpers\CartHelper;
use App\Helpers\NotificationHelper;
use App\Models\vnpays;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Views\Client\Layouts\Header;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use App\Helpers\AuthHelper;
use Mailer;
use App\Views\Client\Pages\Cart\Bill;

class HomeController
{
    // hiển thị danh sách
    public static function index()
    {
        $viewedProducts = isset($_COOKIE['viewed_product']) ? json_decode($_COOKIE['viewed_product'], true) : [];
        $productIds = array_column($viewedProducts, 'product_id');
        $ids = implode(',', array_map('intval', $productIds));
        
        $category = new Category();
        $categories = $category->getAllCategoryByStatus();
        // lấy dữ liệu sản phẩm từ database
        $product = new Product();
        $products = $product->getAllProductByStatus();

        $product_watched =  $product->getProductByWatched($ids);
        $products = array_filter($products, function ($product) use ($product_watched) {

            foreach ($product_watched as $watched) {
                if ($watched['id'] == $product['id']) {
                    return false;
                }
            }
            return true;
        });

        $data = [
            'categories' => $categories,
            'products' => array_merge($product_watched, $products),
        ];
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Home::render($data);
        Footer::render();
    }
}
