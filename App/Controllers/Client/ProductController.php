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
        $product = new Product();

        $products = $product->getAllProductByStatus();
        $data = [
            'products' => $products
        ];
        Header::render();

        Index::render($data);
        Footer::render();
    }
    public static function detail($id)
    {
        $product = new Product();
        $detail = $product->getOneProductByCategoryDetailStatus($id);

         if(!$detail){
            NotificationHelper::error('detail','Không thể xem sản phẩm');
            header('Location: /');
         }
        $comment = new Comment();
        $data = [
            'product' => $detail,
            'comments' => $comment->get5CommentNewestByProductAndStatus($id),
        ];
 
         // $view_result = ViewProductHelper::cookieView($id,$detail['view']);
         
        
        Header::render();
        Notification::render();
        //hủy thông báo
        NotificationHelper::unset();
        Detail::render($data);
        Footer::render();
    }
    
    public static function getProductByCategory($id)
    {
    }
}
