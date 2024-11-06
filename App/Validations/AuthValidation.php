<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class AuthValidation
{
 public static function register(): bool
 {
  $is_valid = true;

  // Tên đăng nhập
  if (!isset($_POST['username']) || $_POST['username'] === '') {
   NotificationHelper::error('username', 'Không để trống tên đăng nhập');

   $is_valid = false;
  }

  // Mật khẩu
  if (!isset($_POST['password']) || $_POST['password'] === '') {
   NotificationHelper::error('password', 'Không để trống mật khẩu');
   $is_valid = false;
  } else {
   if (strlen($_POST['password'] < 3)) {
    NotificationHelper::error('password', 'Mật khẩu phải có ít nhất 3 ký tự');
    $is_valid = false;
   }
  }

  // Nhập lại mật khẩu
  if (!isset($_POST['re_password']) || $_POST['re_password'] === '') {
   NotificationHelper::error('re_password', 'Không để trống nhập lại mật khẩu');
   $is_valid = false;
  } else {
   if ($_POST['re_password'] != $_POST['password']) {
    NotificationHelper::error('re_password', 'Mật khẩu nhập lại không trùng với mật khẩu đã nhập');
    $is_valid = false;
   }
  }

  // Email
  if (!isset($_POST['email']) || $_POST['email'] === '') {
   NotificationHelper::error('email', 'Không để trống Email');
   $is_valid = false;
  } else {
   $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/";
   if(!preg_match($emailPattern, $_POST['email'])){
    NotificationHelper::error('email', 'Email không đúng định dạng');
    $is_valid = false;
   }

   if (!isset($_POST['name']) || $_POST['name'] === '') {
    NotificationHelper::error('name', 'Không để trống tên ');
    $is_valid = false;
   }
 
  }

  return $is_valid;
  
 }
 public static function login(): bool
 {
  $is_valid = true;

  // Tên đăng nhập
  if (!isset($_POST['username']) || $_POST['username'] === '') {
   NotificationHelper::error('username', 'Không để trống tên đăng nhập');
   $is_valid = false;
  }

  // Mật khẩu
  if (!isset($_POST['password']) || $_POST['password'] === '') {
   NotificationHelper::error('password', 'Không để trống mật khẩu');
   // var_dump($_POST['password']);
   $is_valid = false;
  } 

  return $is_valid;
 }

 public static function edit(): bool
 {
  $is_valid = true;


  // Email
  if (!isset($_POST['email']) || $_POST['email'] === '') {
   NotificationHelper::error('email', 'Không để trống Email');
   $is_valid = false;
  } else {
   $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/";
   if(!preg_match($emailPattern, $_POST['email'])){
    NotificationHelper::error('email', 'Email không đúng định dạng');
    $is_valid = false;
   }
  }

  if (!isset($_POST['name']) || $_POST['name'] === '') {
   NotificationHelper::error('name', 'Không để trống tên ');
   $is_valid = false;
  }
  return $is_valid;
 }

 public static function uploadAvatar(){
  if(!file_exists($_FILES['avatar']['tmp_name']) || (!is_uploaded_file($_FILES['avatar']['tmp_name']))){
   return false;
  }

  /// Nơi lưu trữ hình ảnh trong source code
  $target_dir = 'public/uploads/users/';

  // Kiểm tra loại file upload có hợp lệ hay không
  $imageFileType = strtolower(pathinfo(basename($_FILES['avatar']['name']), PATHINFO_EXTENSION));

  if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif'){
   NotificationHelper::error('type','Chỉ nhận file ảnh JPG, PNG, JPEG, GIF');
  }

  // thay đổi tên file thành dạng năm tháng ngày giờ
  $nameImage = date('YmdHmi') . '.' . $imageFileType;

  // đường dẫn đầy đủ để chuyển file
  $target_file = $target_dir.$nameImage;

  if(!move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)){
   NotificationHelper::error('move_upload','Không thể tải ảnh về thư mục lưu trữ');
   return false;
  }

  return $nameImage;
 }
}