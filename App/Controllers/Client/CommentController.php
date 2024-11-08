<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Models\Comment;
use App\Validations\CommentValidation;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Pages\Product\CartProduct;
use App\Views\Client\Layouts\Header;

class CommentController
{
    // hiển thị danh sách
    public static function store()
    {
        $is_valid = CommentValidation::createClient();
        $product_id = $_POST['product_id'];
     
        if (!$is_valid) {
            NotificationHelper::error('create_comment', 'Thêm bình luận thất bại  !');
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
            'content' => $_POST['content'],
            'product_id' => $_POST['product_id'],
            'user_id' => $_POST['user_id'],
            'date' =>  $currentDateTime,
            'status' => $_POST['status'],
        ];
        $comment = new Comment();
        $result = $comment->createComment($data);
        if ($result) {
            NotificationHelper::success('create_comment', 'Thêm bình luận phẩm thành công!');
        } else {
            NotificationHelper::error('create_comment', 'Thêm bình luận phẩm thất bại!');
        }
        header("Location: /products/$product_id");    
    }
    public static function edit($id)
    {
        $is_valid = CommentValidation::editClient();
        $product_id = $_POST['product_id'];
        if (!$is_valid) {
            NotificationHelper::error('create_comment', 'Cập nhật bình luận thất bại  !');
            if (isset($_POST['product_id']) && $_POST['product_id']) {

                header("Location: /products/$product_id");
                exit();
            } else {
                header("Location: /");
            }
            exit();
        }
        $data = [
            'content' => $_POST['content'],
        ];
   
        $comment = new Comment();
        $result = $comment->updateComment($id,$data);
        if ($result) {
            NotificationHelper::success('create_comment', 'Cập nhật phẩm thành công!');
        } else {
            NotificationHelper::error('create_comment', 'Cập nhật phẩm thất bại!');
        }
        header("Location: /products/$product_id");  
    }
    public static function delete($id){
        $comment = new Comment();
        $result = $comment->deleteComment($id);
        $product_id = $_POST['product_id'];
        if ($result) {
            NotificationHelper::success('create_comment', 'Xóa bình luận phẩm thành công!');
        } else {
            NotificationHelper::error('create_comment', 'Xóa bình luận phẩm thất bại!');
        }
        header("Location: /products/$product_id");  
    }
}
