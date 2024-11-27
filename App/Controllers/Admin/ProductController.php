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
use App\Views\Admin\Pages\Product\SettingVariant;
use App\Views\Admin\Pages\Product\SettingPriceVariant;
use App\Views\Admin\Pages\Product\DetailSettingVariant;
use App\Views\Admin\Pages\Product\createAttributeVariant;
use App\Views\Admin\Pages\Recycle\ProductRecycle;
use App\Helpers\AuthHelper;;

class ProductController
{


    // hiển thị danh sách
    public static function index()
    {

        AuthHelper::checkPermission([0, 4]);
        $product = new Product();        
        $data = $product->getAllProductByPagina();
        Header::render();
        Notification::render();
        //hủy thông báo     
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }


    // hiển thị giao diện form thêm
    public static function create()
    {
        AuthHelper::checkPermission([0, 4]);
        // $product = new Product();
        $category = new Category();
        $categories = $category->getAllCategory();

        // var_dump($data);
        // $data = $product->getAllProduct();
        // var_dump($_SESSION);
        $data = [
            'categories' => $categories,
        ];

        Header::render();
        // hiển thị form thêm
        Notification::render();
        NotificationHelper::unset();
        Create::render($data);
        Footer::render();
    }


    // // // xử lý chức năng thêm
    public static function store()
    {
        // validation các trường dữ liệu
        $is_valid = ProductValidation::create();

        if (!$is_valid) {
            NotificationHelper::error('store_product', 'Thêm sản phẩm thất bại');
            header('location: /admin/products/create');
            exit;
        }
        $name = $_POST['name'];
        $tatus = $_POST['status'];
        // Kiểm tra các tên có tồn tại hay chưa
        $product = new Product();
        $is_exist = $product->getOneProductByName($name);

        if ($is_exist) {
            NotificationHelper::error('store_product2', 'Tên sản phẩm này đã tồn tại');
            header('location: /admin/products/create');
            exit;
        }


        // Thêm vào
        $data = [
            'name' => $name,
            'price' => $_POST['price'],
            'discount_price' => $_POST['discount_price'],
            'description' => $_POST['description'],
            'short_description' => $_POST['short_description'],
            'date' => $_POST['date'],
            'origin' => $_POST['origin'],   
            'is_featured' => $_POST['is_featured'],
            'status' => $_POST['status'],
            'category_id' => $_POST['category_id'],
        ];
        $is_upload = ProductValidation::updateImage();
        //  var_dump($is_upload);
        if ($is_upload) {
            $data['image'] = $is_upload;
        }
        $result = $product->createProduct($data);

        if ($result) {
            NotificationHelper::success('create_product', 'Thêm sản phẩm thành công');
            header('location: /admin/products');
        } else {
            NotificationHelper::error('create_product', 'Thêm sản phẩm thất bại');
            header('location: /admin/products/create');
            exit;
        }
    }


    public static function edit(int $id)
    {
        AuthHelper::checkPermission([0, 4]);
        $product = new product();
        $data_product = $product->getOneproduct($id);
        $category = new category();
        $data_category = $category->getAllCategory();
        if (!$data_product) {
            NotificationHelper::error('edit_product', 'Không thể xem sản phẩm này!');
            header('Location: /admin/products');
        }
        $data = [
            'product' => $data_product,
            'category' => $data_category,

        ];
        //    echo '<pre>';
        //    var_dump($data['product']['name']);
        Header::render();
        Notification::render();
        //hủy thông báo
        NotificationHelper::unset();
        // hiển thị form sửa
        Edit::render($data);
        Footer::render();
    }


    public static function update(int $id)
    {

        $is_valid = ProductValidation::edit();
        if (!$is_valid) {
            NotificationHelper::error('update_product2', 'Cập nhật sản phẩm thất bại  !');
            header("Location: /admin/products/$id");
            exit();
        }
        $name = $_POST['name'];

        // kiểm tra product name đã tồn tại chgx nếu có thì thông báo ra 
        $product = new product();
        $is_exist = $product->getOneproductByName($name);

        if ($is_exist && $is_exist['id'] != $id) {
            NotificationHelper::error('update_product', 'Tên loại sản phẩm đã tồn tại!');
            header("Location: /admin/products/$id");
            exit();
        }
        $data = [
            'name' => $name,
            'price' => $_POST['price'],
            'discount_price' => $_POST['discount_price'],
            'description' => $_POST['description'],
            'date' => $_POST['date'],
            'origin' => $_POST['origin'], 
            'short_description' => $_POST['short_description'],
            'category_id' => $_POST['category_id'],
            'is_featured' => $_POST['is_featured'],
            'status' => $_POST['status'],
        ];
        $is_upload = ProductValidation::updateImage();
        if ($is_upload) {
            $data['image'] = $is_upload;
        }
        $result = $product->updateproduct($id, $data);
        if ($result) {
            NotificationHelper::success('update_products', 'Cập nhật sản phẩm thành công!');
            header('Location: /admin/products');
        } else {
            NotificationHelper::error('update_products', 'Cập nhật sản phẩm thất bại!');
            header("Location: /admin/products/$id");
        }
    }



    public static function delete(int $id)
    {
        $product = new product();
        $is_exist = $product->getOneProduct($id);
        if ($is_exist && $is_exist['id'] === $id) {
            $data = [
                'status' => 0,
            ];
            $result = $product->updateproduct($id, $data);
        }
        if ($result) {
            NotificationHelper::success('delete_product', 'Xóa sản phẩm thành công!');
            header('Location: /admin/products');
        } else {
            NotificationHelper::error('delete_product', 'Xóa sản phẩm thất bại!');
            header("Location: /admin/products");
        }
    }

    public static function productRecycle()
    {
        AuthHelper::checkPermission([0]);
        $product = new Product();
        $data = $product->getAllProductByStatusRecycle();
        Header::render();
        Notification::render();
        //hủy thông báo
        NotificationHelper::unset();
        ProductRecycle::render($data);
        Footer::render();
    }

    public static function restore(int $id)
    {
        $product = new Product();
        $is_exist = $product->getOneProduct($id);
        if ($is_exist && $is_exist['id'] === $id) {
            $data = [
                'status' => 1,
            ];
            $result = $product->updateproduct($id, $data);
        }
        if ($result) {
            NotificationHelper::success('restore_product', 'Khôi phục sản phẩm thành công!');
            header('Location: /admin/recycle/products');
        } else {
            NotificationHelper::error('restore_product', 'Khôi phục sản phẩm thất bại!');
            header("Location: /admin/recycle/products");
        }
    }
    public static function deletePermanently(int $id)
    {
        $product = new Product();
        $is_exist = $product->getOneProduct($id);
        if ($is_exist && $is_exist['id'] === $id) {
            $data = [
                'status' => 2,
            ];
            $result = $product->updateproduct($id, $data);
        }
        if ($result) {
            NotificationHelper::success('deletePermanently_product', 'Xóa vĩnh viễn sản phẩm thành công!');
            header('Location: /admin/recycle/products');
        } else {
            NotificationHelper::error('deletePermanently_product', 'Xóa vĩnh viễn sản phẩm thất bại!');
            header("Location: /admin/recycle/products");
        }
    }
    public function searchProduct()
    {

        $keyword = $_GET['keywords'] ?? '';
        $keyword = trim($keyword);
      
        if (empty($keyword)) {
            $_SESSION['keywords'] = null; 
       
            $data = [];
            Header::render();
            Index::render($data);
            Footer::render();
            return;  
        }
        $_SESSION['keywords'] = $keyword;

        $product = new Product();
        $data = $product->search($keyword);
      
        Header::render();
        Index::render($data);
        Footer::render();
    }
}
