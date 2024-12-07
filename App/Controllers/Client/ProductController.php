<?php

namespace App\Controllers\Client;

use App\Helpers\AuthHelper;
use App\Helpers\NotificationHelper;
use App\Helpers\ViewProductHelper;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Rating;
use App\Models\ProductVariant;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Product\Category as ProductCategory;
use App\Views\Client\Pages\Product\Detail;
use App\Views\Client\Pages\Product\Index;
use App\Validations\ProductValidation;

use App\Models\Origin;


class ProductController
{

    private static function getQueryParams()
    {
        $queryParams = [];
        if (isset($_GET['sort'])) {
            $queryParams['sort'] = $_GET['sort'];
        }
        if (isset($_GET['origin'])) {
            $queryParams['origin'] = $_GET['origin'];
        }
        if (isset($_GET['categories'])) {
            $queryParams['categories'] = $_GET['categories'];
        }
        if (isset($_GET['price'])) {
            $queryParams['price'] = $_GET['price'];
        }
        return $queryParams;
    }
    // hiển thị danh sách
    public static function index()
    {

        $queryParams = self::getQueryParams();
        // giả sử data là mảng dữ liệu lấy được từ database
       
        $category = new Category();
        $categories = $category->getAllCategoryByStatus();

        // lấy dữ liệu sản phẩm từ database
        $product = new Product();
        if (empty($queryParams)) {
            $products = $product->getAllProductByStatus();
        } else {
            $products = $product->getProductsWithFilters($queryParams);
        }
      
        $data = [
            'products' => $products,
            'categories' => $categories,
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
        $variants = new ProductVariant();
        $recommended = $product->recommendedProducts($recommendedProducts);

        $detail = $product->getOneProductByCategoryDetailStatus($id);
        $variant = $variants->getAllVariantByProductId($id);
        if (!$detail) {
            NotificationHelper::error('detail', 'Không thể xem sản phẩm');
            header('Location: /');
        }
        $category_id = $detail[0]['category_id'];
        $comment = new Comment();
        $rating = new Rating();
        $data = [
            'product' => $detail,
            'recommended' => $recommended,
            'comments' => $comment->get5CommentNewestByProductAndStatus($id),
            'variant' => $variant,
            'rating' => $rating->get5RatingNewestByProductAndStatus($id),
            'average_rating' => $rating->getAverageRatingByProduct($id),
            'countRating' => $rating->countRatingByProduct($id),
        ];
        // var_dump($data);
        // die;

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

    public function searchProduct()
    {
        $keyword = $_GET['keywords'] ?? '';
        $keyword = trim($keyword);
        if (empty($keyword)) {
            $_SESSION['keywords'] = null;

            $data = [
                'products' => [],
                'categories' => (new Category())->getAllCategoryByStatus(),
                'origins' => (new Origin())->getAllOriginsByStatus(),
            ];
            Header::render();
            Index::render($data);
            Footer::render();
            return;
        }
        $_SESSION['keywords'] = $keyword;

        $product = new Product();
        $key_product = $product->search($keyword);

        $category = new Category();
        $categories = $category->getAllCategoryByStatus();

        $origins = new Origin();
        $origins = $origins->getAllOriginsByStatus();
        $data = [
            'products' => $key_product,
            'categories' => $categories,
            'origins' => $origins,
        ];
        Header::render();
        Index::render($data);
        Footer::render();
    }


    public static function ratingAction()
    {
        $is_valid = ProductValidation::createRating();
        $product_id = $_POST['product_id'] ?? null;
        if (!$is_valid) {
            NotificationHelper::error('create_rating', 'Gửi đánh giá thất bại!');
            if (isset($_POST['product_id']) && $_POST['product_id']) {
                header("Location: /products/$product_id");
                exit();
            } else {
                header('Location: /');
            }
            exit();
        }
        $currentDateTime = date('Y-m-d H:i:s');
        $data = [
            'product_id' => $_POST['product_id'],
            'user_id' => $_POST['user_id'],
            'rating' => $_POST['rating_data'],
            'content' => $_POST['user_review'],
            'created' =>  $currentDateTime,

        ];
        $rating = new Rating();
        $result = $rating->createRatings($data);
        if ($result) {
            NotificationHelper::success('create_rating', 'Gửi đánh giá thành công!');
        } else {
            NotificationHelper::error('create_rating', 'Gửi đánh giá thất bại!');
        }
        header("Location: /products/$product_id");
    }

    
}
