<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class CategoryValidation {

 public static function create(){
  $is_valid = true;

  // Tên đăng nhập
  if (!isset($_POST['name']) || $_POST['name'] === '') {
   NotificationHelper::error('name', 'Không để trống tên');
   $is_valid = false;
  }

  // Mật khẩu
  if (!isset($_POST['status']) || $_POST['status'] === '') {
   NotificationHelper::error('status', 'Không để trống trạng thái');
   // var_dump($_POST['status']);
   $is_valid = false;
  } 

  return $is_valid;
 }

 public static function edit(){
  $is_valid = true;

  // Tên đăng nhập
  if (!isset($_POST['name']) || $_POST['name'] === '') {
   NotificationHelper::error('name', 'Không để trống tên');
   $is_valid = false;
  }

  // Mật khẩu
  if (!isset($_POST['status']) || $_POST['status'] === '') {
   NotificationHelper::error('status', 'Không để trống trạng thái');
   // var_dump($_POST['status']);
   $is_valid = false;
  } 

  return $is_valid;
 }
}