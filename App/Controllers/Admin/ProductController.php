<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Product;
use App\Models\Category;
use App\Validations\ProductValidation;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Product\Create;
use App\Views\Admin\Pages\Product\Edit;
use App\Views\Admin\Pages\Product\Index;

class ProductController
{


    // hiển thị danh sách
    public static function index()
    {
        
        $product = new Product();
        $data = $product->getAllProduct();

        // var_dump($data);

        Header::render();
        // hiển thị giao diện danh sách
        Index::render($data);
        Footer::render();
    }


    // hiển thị giao diện form thêm
    // public static function create()
    // {

    //     $category = new Category();
    //     $data = $category->getAllCategory();
    //     // var_dump($_SESSION);
    //     Header::render();
    //     // hiển thị form thêm
    //     Notification::render();
    //     NotificationHelper::unset();
    //     Create::render($data);
    //     Footer::render();
    // }


    // // // xử lý chức năng thêm
    // public static function store()
    // {
    //     // validation các trường dữ liệu
    //     $is_valid = ProductValidation::create();

    //     if(!$is_valid){
    //         NotificationHelper::error('store', 'Thêm sản phẩm thất bại');
    //         header('location: /admin/products/create');
    //         exit;
    //     }
    //     $name  = $_POST['name'];
    //     $tatus = $_POST['status'];
    //     // Kiểm tra các tên có tồn tại hay chưa
    //     $product = new Product();
    //     $is_exist = $product->getOneProductByName($name);
        
    //     if ($is_exist) {
    //         NotificationHelper::error('store', 'Tên sản phẩm này đã tồn tại');
    //         header('location: /admin/products/create');
    //         exit;
    //     }

    //     // Thêm vào
    //     $data = [
    //         'name' => $name,
    //         'price' => $_POST['price'],
    //         'discount_price' => $_POST['discount_price'],
    //         'description' => $_POST['description'],
    //         'is_featured' => $_POST['is_featured'],
    //         'status' => $_POST['status'],
    //         'category_id' => $_POST['category_id'],
    //     ];

    //     $is_upload = ProductValidation::uploadImage();
    //     if($is_upload){
    //         $data['image'] = $is_upload;
    //     }
    //     $result = $product->createProduct($data);

    //     if($result){
    //         NotificationHelper::success('store', 'Thêm sản phẩm thành công');
    //         header('location: /admin/products');
    //     }else{
    //         NotificationHelper::error('store', 'Thêm sản phẩm thất bại');
    //         header('location: /admin/products/create');
    //         exit;
    //     }
    // }


    // // hiển thị giao diện form sửa
    // public static function edit(int $id)
    // {

    //     $product = new Product();
    //     $data_product = $product->getOneProduct($id);

    //     $category = new Category();
    //     $data_category = $category->getAllCategory();

    //     if(!$data_product){
    //         NotificationHelper::error('edit','Không thể xem sản phẩm này');
    //         header('location: /admin/products');
    //         exit;
    //     }
    //     $data = [
    //         'product' => $data_product,
    //         'category' => $data_category,
    //     ];

    //     // echo '<pre>';
    //     // var_dump($data);

    //     Header::render();
    //     Notification::render();
    //     NotificationHelper::unset();
    //     // Hiển thị form sửa
    //     Edit::render($data);
    //     Footer::render();

    //     // if ($data) {
    //     //     Header::render();
    //     //     // hiển thị form sửa
    //     //     Edit::render($data);
    //     //     Footer::render();
    //     // } else {
    //     //     header('location: /admin/products');
    //     // }
    // }


    // // // xử lý chức năng sửa (cập nhật)
    // public static function update(int $id)
    // {
    //     $is_valid = ProductValidation::edit();

    //     if(!$is_valid){
    //         NotificationHelper::error('update', 'Cập nhật sản phẩm thất bại');
    //         header("location: /admin/products/$id");
    //         exit;
    //     }
    //     $name  = $_POST['name'];
    //     $status = $_POST['status'];
    //     // Kiểm tra các tên có tồn tại hay chưa
    //     $product = new Product();
    //     $is_exist = $product->getOneProductByName($name);        
    //     if ($is_exist) {
    //         if($is_exist['status'] == $status){
    //             if($is_exist['id']){
    //                 NotificationHelper::error('store', 'Tên sản phẩm này đã tồn tại');
    //                 header("location: /admin/products/$id");
    //             exit;
    //             }
    //         }        
    //     }

    //     // Thực hiện cập nhật
    //     $data = [
    //         'name' => $name,
    //         'price' => $_POST['price'],
    //         'discount_price' => $_POST['discount_price'],
    //         'description' => $_POST['description'],
    //         'is_featured' => $_POST['is_featured'],
    //         'status' => $_POST['status'],
    //         'category_id' => $_POST['category_id'],
    //     ];

    //     $is_upload = ProductValidation::uploadImage();
    //     if($is_upload){
    //         $data['image'] = $is_upload;
    //     }
        
    //     $result = $product->updateProduct($id, $data);

    //     if($result){
    //         NotificationHelper::success('update', 'Cập nhật sản phẩm thành công');
    //         header('location: /admin/products');
    //     }else{
    //         NotificationHelper::error('update', 'Cập nhật sản phẩm thất bại');
    //         header("location: /admin/products/$id");
    //         exit;
    //     }

    // }


    // // // thực hiện xoá
    // public static function delete(int $id)
    // {
    //     $product = new Product();
    //     $result = $product->deleteProduct($id);

    //     // var_dump($result);
    //     if($result){
    //         NotificationHelper::success('delete', 'Xóa sản phẩm thành công');
    //         header('location: /admin/products');
    //     } else{
    //         NotificationHelper::error('delete', 'Xóa sản phẩm thất bại');
    //     }
    // }
}
