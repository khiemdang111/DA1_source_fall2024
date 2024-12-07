<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Vourcher;
use App\Models\User;
use App\Validations\VourcherValidation;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Vourcher\Create;
use App\Views\Admin\Pages\Vourcher\Edit;
use App\Views\Admin\Pages\Vourcher\Index;
use App\Helpers\AuthHelper;

class VourcherController
{



    public static function index()
    {
        $vourcher = new Vourcher();
        $data = $vourcher->getAlldiscount_codesJoinUser();

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
        $user = new User();
        $user_all = $user->getAllUser();


        $data = [
            'user_all' => $user_all,

        ];
        // var_dump($_SESSION);
        Header::render();
        // hiển thị form thêm
        Notification::render();
        NotificationHelper::unset();
        Create::render($data);
        Footer::render();
    }

    public static function store()
    {
        // validation các trường dữ liệu
        $is_valid = VourcherValidation::create();

        if (!$is_valid) {
            NotificationHelper::error('store_category', 'Thêm loại sản phẩm thất bại');
            header('location: /admin/vourcher/create');
            exit;
        }
        // var_dump($_POST);
        // die;
        $name  = $_POST['name'];
        $unit  = $_POST['unit'];
        $date_start  = $_POST['date_start'];
        $date_end  = $_POST['date_end'];
        $status = $_POST['status'];
        $user_id = $_POST['user_id'];


        $data = [
            'name' => $name,
            'unit' => $unit,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'status' => $status,
            'user_id' => $user_id,
        ];
        $vourcher = new Vourcher();
        $result = $vourcher->createDiscount_codes($data);

        if ($result) {
            NotificationHelper::success('store_vourcher', 'Thêm vourcher thành công');
            header('location: /admin/vourcher');
        } else {
            NotificationHelper::error('store_vourcher', 'Thêm vourcher thất bại');
            header('location:/admin/vourcher/create');
            exit;
        }
    }

    public static function edit(int $id)
    {
        AuthHelper::checkPermission([0, 4]);
        $vourcher = new Vourcher();
        $data = $vourcher->getOneDiscount_codes($id);
        if (!$data) {
            NotificationHelper::error('edit_category', 'Không thể xem vourcher này!');
            header('Location: /admin/vourcher');
        }

        $user = new User();
        $user_all = $user->getAllUser();

        $data = [
            'vourcher' => $data,
            'user_all' => $user_all,

        ];
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

        $is_valid =  VourcherValidation::edit();
        if (!$is_valid) {
            NotificationHelper::error('update_vourcher', 'Cập nhật vourcher thất bại  !');
            header("Location: /admin/vourcher/$id");
            exit();
        }


        $name  = $_POST['name'];
        $unit  = $_POST['unit'];
        $date_start  = $_POST['date_start'];
        $date_end  = $_POST['date_end'];
        $status = $_POST['status'];
        $user_id = $_POST['user_id'];



        $data = [
            'name' => $name,
            'unit' => $unit,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'status' => $status,
            'user_id' => $user_id,
        ];
        $vourcher = new Vourcher();
        $result = $vourcher->updateDiscount_codes($id, $data);
        if ($result) {
            NotificationHelper::success('update', 'Cập nhật vourcher thành công!');
            header('Location: /admin/vourcher');
        } else {
            NotificationHelper::error('update', 'Cập nhật vourcher thất bại!');
            header("Location:  /admin/vourcher/$id");
        }
    }

    public static function delete(int $id)
    {
        $vourcher = new Vourcher();
        $is_exist = $vourcher->getOneDiscount_codes($id);
        if ($is_exist && $is_exist['id'] === $id) {
            $data = [
                'status' => 0,
            ];
            $result = $vourcher->updateDiscount_codes($id, $data);
        }
        if ($result) {
            NotificationHelper::success('delete_vourcher', 'Xóa bài vourcher thành công!');
            header('Location: /admin/vourcher');
        } else {
            NotificationHelper::error('delete_vourcher', 'Xóa vourcher thất bại!');
            header("Location: /admin/vourcher");
        }
    }


    public function searchVourcher()
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
        $vourcher = new Vourcher();
        $data = $vourcher->search($keyword);
      
        Header::render();
        Index::render($data);
        Footer::render();
    }
}
