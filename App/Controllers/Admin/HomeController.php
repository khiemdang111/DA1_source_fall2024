<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Category;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Home;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
class HomeController
{
    // hiển thị danh sách
    public static function index()
    {
         $user = new User();
         $total_user = $user->countTotalUser();
         //var_dump( $total_user);
         $product = new Product();
         $total_product = $product->countTotalProduct();
   
         $product_by_category = $product->countProductByCategory();
         $product_view = $product->getTopViewedProducts();
         $category = new Category();
         $total_category = $category->countTotalCategory();

         $comment = new Comment();
         $total_comment = $comment->countTotalComment();
         $comment_by_product = $comment->countCommentByProduct();

         $data =[
            'total_user' => $total_user['total'],
            'total_product' => $total_product['total'],
            'total_category' => $total_category['total'],
            'total_comment' => $total_comment['total'],
            'product_by_category' => $product_by_category,
            'comment_by_product' => $comment_by_product,
            'product_view' => $product_view,
         ];
        

        Header::render();
        Home::render($data);
        Footer::render();
    }
}
