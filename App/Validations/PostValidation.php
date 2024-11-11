<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class PostValidation {

 public static function create(){
  $is_valid = true;

  // Tên đăng nhập
  if (!isset($_POST['title']) || $_POST['title'] === '') {
   NotificationHelper::error('title', 'Không để trống tiêu đề');

   $is_valid = false;
  }

  if (!isset($_POST['summary']) || $_POST['summary'] === '') {
    NotificationHelper::error('summary', 'Không để trống mô tả ngắn');
 
    $is_valid = false;
   }

   if (!isset($_POST['content']) || $_POST['content'] === '') {
    NotificationHelper::error('content', 'Không để trống mô tả ngắn');
 
    $is_valid = false;
   }

   if (!isset($_POST['user_id']) || $_POST['user_id'] === '') {
    NotificationHelper::error('user_id', 'Không để trống tác giả');
    $is_valid = false;
   }

   if (!isset($_POST['category_post_id']) || $_POST['category_post_id'] === '') {
    NotificationHelper::error('category_post_id', 'Không để trống thể loại');
    $is_valid = false;
   }

   if (!isset($_POST['status']) || $_POST['status'] === '') {
    NotificationHelper::error('status', 'Không để trống trạng thái');
    $is_valid = false;
   }



   


  return $is_valid;
 }

 public static function edit(){
  $is_valid = true;


  
  } 


   
   
  
  

 public static function uploadAvatar(){
  return AuthValidation::uploadAvatar();
 }

}