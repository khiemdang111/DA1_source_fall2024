<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class CommentValidation {

 public static function createClient(){
  $is_valid = true;

  if (!isset($_POST['content']) || $_POST['content'] === '') {
   NotificationHelper::error('content', 'Không để trống nội dung bình luận');
   $is_valid = false;
  } 
  if (!isset($_POST['product_id']) || $_POST['product_id'] === '') {
   NotificationHelper::error('product_id', 'Không để trống mã sản phẩm');
   $is_valid = false;
  } 
  if (!isset($_POST['user_id']) || $_POST['user_id'] === '') {
   NotificationHelper::error('user_id', 'Không để trống mã người dùng');
   $is_valid = false;
  } 
  // Tên đăng nhập
 
  return $is_valid;
 }


 public static function editClient(){
  $is_valid = true;

  if (!isset($_POST['content']) || $_POST['content'] === '') {
   NotificationHelper::error('content', 'Không để trống nội dung bình luận');
   $is_valid = false;
  } 
  if (!isset($_POST['product_id']) || $_POST['product_id'] === '') {
   NotificationHelper::error('product_id', 'Không để trống mã sản phẩm');
   $is_valid = false;
  } 
  if (!isset($_POST['user_id']) || $_POST['user_id'] === '') {
   NotificationHelper::error('user_id', 'Không để trống mã người dùng');
   $is_valid = false;
  } 
  // Tên đăng nhập
 
  return $is_valid;
 }

 public static function edit(){
  $is_valid = true;

  // Tên đăng nhập


  // Mật khẩu
  if (!isset($_POST['status']) || $_POST['status'] === '') {
   NotificationHelper::error('status', 'Không để trống trạng thái');
   // var_dump($_POST['status']);
   $is_valid = false;
  } 

  return $is_valid;
 }
}