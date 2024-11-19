<?php

namespace App\Controllers\Client;

use App\Helpers\AuthHelper;
use App\Helpers\NotificationHelper;
use App\Helpers\ViewProductHelper;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Product\Category as ProductCategory;
use App\Views\Client\Pages\Product\Detail;
use App\Views\Client\Pages\Product\Index;

class ProductController
{
    // hiển thị danh sách
    public static function index()
    {
        // giả sử data là mảng dữ liệu lấy được từ database
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

        Index::render($data);
        Footer::render();
    }
    public static function fetchRecommendedProducts($product_id)
    {
        $api_url = "http://127.0.0.1:5000/api?product_id=" . $product_id;

        $response = @file_get_contents($api_url);

        if ($response === FALSE) {
            error_log("Error connecting to Flask API: $api_url");
            return null;
        }

        $data = json_decode($response, true);

        if (!isset($data['recommended_products']) || !is_array($data['recommended_products'])) {
            error_log("Invalid data structure from Flask API: $response");
            return null;
        }

        return $data['recommended_products'];
    }
    public static function detail(int $id)
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($requestUri, '/'));
        $productId = isset($segments[1]) ? (int)$segments[1] : null;
        if ($productId) {
            $viewedProducts = isset($_COOKIE['viewed_product']) ? json_decode($_COOKIE['viewed_product'], true) : [];
            if (!in_array($productId, array_column($viewedProducts, 'product_id'))) {
                array_unshift($viewedProducts, ['product_id' => (int)$productId]);
            }
            if (count($viewedProducts) > 5) {
                array_pop($viewedProducts);
            }
            setcookie('viewed_product', json_encode($viewedProducts), time() + (86400 * 30), "/");
            $_COOKIE['viewed_product'] = json_encode($viewedProducts);
        }
        
        $recommendedProducts = self::fetchRecommendedProducts($id);
        if (is_array($recommendedProducts) && !empty($recommendedProducts)) {
            $recommendedProducts = array_map(function ($name) {
                return "'" . addslashes($name) . "'";  
            }, $recommendedProducts);
            $recommendedProducts = implode(',', $recommendedProducts);
        } else {
            $recommendedProducts = "";  
        }
        $product = new Product();
        $recommended = $product->recommendedProducts($recommendedProducts);

        $detail = $product->getOneProductByCategoryDetailStatus($id);
         if(!$detail){
            NotificationHelper::error('detail','Không thể xem sản phẩm');
            header('Location: /');
        }
        $category_id = $detail[0]['category_id'];
        $comment = new Comment();
        $data = [
            'product' => $detail,
            'comments' => $comment->get5CommentNewestByProductAndStatus($id),
        ];
        $view_result = ViewProductHelper::cookieView($id, $detail[0]['view']);
        Header::render();
        Notification::render();
        //hủy thông báo
        NotificationHelper::unset();
        Detail::render($data);
        Footer::render();
    }
    public static function getProductByCategory($id)
    {
        $product = new Product();
        $return_product_category = $product->getAllProductJoinCategoryDetail($id);
        $category = new Category();
        $categories = $category->getAllCategoryByStatus();
        $data = [
            'products' => $return_product_category,
            'categories' => $categories
        ];
        Header::render();
        Index::render($data);
        Footer::render();
    }
}
