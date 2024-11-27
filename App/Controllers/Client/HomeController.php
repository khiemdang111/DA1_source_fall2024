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
use App\Models\Post;
use App\Models\User;
use App\Helpers\AuthHelper;
use App\Views\Error\NotFound;
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
        $products = $product->getAllProductLimit8();

        $posts = new Post();
        $post = $posts->getAllPostLimit4();
        $product_watched = $product->getProductByWatched($ids);
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
            'posts' => $post
        ];


        Header::render();
        Notification::render();
        NotificationHelper::unset();
        NotificationHelper::unsetorder();
        Home::render($data);
        Footer::render();
    }
    public static function thanks()
    {
        $is_login = AuthHelper::checkLogin();
        if($is_login){
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $vnp_ResponseCode = $_GET['vnp_ResponseCode'] ?? null;
                if ($vnp_ResponseCode == '00') {
                    $cart_data = CartController::getorder();
                    CartHelper::createCart($cart_data);
                    setcookie('cart', '', time() - (3600 * 24 * 30 * 12), '/');
                    $timeStr = $_GET['vnp_PayDate'];
                    // Chuyển chuỗi sang timestamp
                    $timestamp = strtotime(substr($timeStr, 0, 8) . ' ' . substr($timeStr, 8));
                    $date = date("Y-m-d H:i:s", $timestamp);
                    $data = [
                        "vnp_Amount" => $_GET['vnp_Amount'],
                        "vnp_BankCode" => $_GET['vnp_BankCode'],
                        "vnp_BankTranNo" => $_GET['vnp_BankTranNo'],
                        "vnp_CardType" => $_GET['vnp_CardType'],
                        "vnp_OrderInfo" => $_GET['vnp_OrderInfo'],
                        "vnp_PayDate" => $date,
                        "vnp_ResponseCode" => $_GET['vnp_ResponseCode'],
                        "vnp_TransactionStatus" => $_GET['vnp_TransactionStatus'],
                        "vnp_TxnRef" => $_GET['vnp_TxnRef'],
                        "order_id" => $_SESSION['order_id'],
                    ];
                    // var_dump($data);
                    // die;
                    $vnpays = new vnpays();
                    $vnpays->createVnpay($data);
                    Bill::render();
                } else {
                    // Thất bại hoặc bị hủy
                    header('Location: http://127.0.0.1:8080/checkout');
                    unset($_SESSION['information']);
                    exit();
                }
            }
        } else {
            NotificationHelper::error('s', 'Bnạ không có quyền truy cập trang này!');
            header('location: /');
        }

    }
    public static function notFound(){
        NotFound::render();
    }
}
