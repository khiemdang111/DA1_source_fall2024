<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Category;
use App\Validations\CategoryValidation;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Category\Create;
use App\Views\Admin\Pages\Category\Edit;
use App\Views\Admin\Pages\Category\Index;

class CategoryController
{


    // hiển thị danh sách
    public static function index()
    {
        $category = new Category();
        $data = $category->getAllCategoryByStatus();

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        // hiển thị giao diện danh sách
        Index::render($data);
        Footer::render();
    }


    // hiển thị giao diện form thêm
    public static function create()
    {

        // var_dump($_SESSION);
        Header::render();
        // hiển thị form thêm
        Notification::render();
        NotificationHelper::unset();
        Create::render();
        Footer::render();
    }


    // // xử lý chức năng thêm
    public static function store()
    {
        // validation các trường dữ liệu
        $is_valid = CategoryValidation::create();

        if (!$is_valid) {
            NotificationHelper::error('store_category', 'Thêm loại sản phẩm thất bại');
            header('location: /admin/categories/create');
            exit;
        }
        // var_dump($_POST);
        // die;
        $name  = $_POST['name'];
        $status = $_POST['status'];

        // Kiểm tra các tên loại có tồn tại hay chưa
        $category = new Category();
        $is_exist = $category->getOneCategoryByName($name);

        if ($is_exist) {
            NotificationHelper::error('store_category_name', 'Tên loại sản phẩm này đã tồn tại');
            header('location: /admin/categories/create');
            exit;
        }

        // Thêm vào
        $data = [
            'name' => $name,
            'description' => $_POST['description'],
            'status' => $status,
        ];

        $result = $category->createCategory($data);

        if ($result) {
            NotificationHelper::success('store_category', 'Thêm loại sản phẩm thành công');
            header('location: /admin/categories');
        } else {
            NotificationHelper::error('store_category', 'Thêm loại sản phẩm thất bại');
            header('location: /admin/categories/create');
            exit;
        }
    }


    // hiển thị giao diện form sửa
    public static function edit(int $id)
    {
        $category = new Category();
        $data = $category->getOneCategory($id);
        if (!$data) {
            NotificationHelper::error('edit_category', 'Không thể xem loại sản phẩm này!');
            header('Location: /admin/categories');
        }
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

        $is_valid =  CategoryValidation::edit();
        if (!$is_valid) {
            NotificationHelper::error('update_category2', 'Cập nhật loại sản phẩm thất bại  !');
            header("Location: /admin/categories/$id");
            exit();
        }
        

        $name = $_POST['name'];
        $status = $_POST['status'];
        // kiểm tra category name đã tồn tại chgx nếu có thì thông báo ra 
        $category = new Category();
        $is_exist = $category->getOneCategoryByName($name);

        if ($is_exist && $is_exist['id'] != $id) {
            NotificationHelper::error('update_category', 'Tên loại sản phẩm đã tồn tại!');
            header("Location: /admin/categories/$id");
            exit();
        }



        $data = [
            'name' => $name,
            'description' => $_POST['description'],
            'status' => $status,
        ];

        $result = $category->updateCategory($id, $data);
        if ($result) {
            NotificationHelper::success('update', 'Cập nhật loại sản phẩm thành công!');
            header('Location: /admin/categories');
        } else {
            NotificationHelper::error('update', 'Cập nhật loại sản phẩm thất bại!');
            header("Location: /admin/categories/$id");
        }
    }

    public static function delete(int $id)
    {

        // $id = $_POST['id'];

        // $category = new Category();
        // $result = $category->getAllCategoryProductByStatus($id);
        // if ($result) {
        //     NotificationHelper::success('delete_category2', 'Danh mục đã có sản phẩm không xóa được!');
        //     header('Location: /admin/categories');
        // }else{
        $category = new Category();
        $is_exist = $category->getOnecategory($id);
        if ($is_exist && $is_exist['id'] === $id) {
            $result = $category->getAllCategoryProductByStatus($id);
            if ($result) {
                NotificationHelper::error('delete_category2', 'Danh mục đã có sản phẩm không xóa được!');
                header('Location: /admin/categories');
                exit();
            }
            $data = [
                'status' => 0,
            ];
            $result = $category->updateCategory($id, $data);
        }
        if ($result) {
            NotificationHelper::success('delete_product', 'Xóa loại sản phẩm thành công!');
            header('Location: /admin/categories');
        } else {
            NotificationHelper::error('delete_product', 'Xóa loại sản phẩm thất bại!');
            header("Location: /admin/categories");
        }

    }

    public function searchCategory()
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
        $category = new Category();
        $data = $category->search($keyword);
      
        Header::render();
        Index::render($data);
        Footer::render();
    }
}
