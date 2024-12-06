<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Order_detail;
use App\Models\User;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\User\Create;
use App\Views\Admin\Pages\User\Edit;
use App\Views\Admin\Pages\User\History_detail;
use App\Views\Admin\Pages\User\index;
use App\Validations\UserValidation;
use App\Views\Admin\Pages\Recycle\UserRecycle;
use App\Helpers\AuthHelper;
use App\Models\Order;
use App\Views\Admin\Pages\User\History;

class UserController
{


    // hiển thị danh sách
    public static function index()
    {
        AuthHelper::checkPermission([0]);
        $user = new User();
        $data = $user->getAllUser();

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        index::render($data);
        Footer::render();
    }


    public static function create()
    {
        AuthHelper::checkPermission([0]);
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Create::render();
        Footer::render();
    }


    public static function store()
    {
        $is_valid = UserValidation::create();
        if (!$is_valid) {

            NotificationHelper::error('store', 'Thêm khách hàng thất bại');
            header('location: /admin/users/create');
            exit();
        }
        $username = $_POST['username'];
        $user = new User();
        $is_exsite = $user->getOneUserByUsername($username);
        if ($is_exsite) {
            NotificationHelper::error('store', 'Tên loại người dùng đã tồn tại');
            header('location: /admin/users/create');
            exit();
        }

        $data = [
            'username' => $username,
            'email' => $_POST['email'],
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'status' => $_POST['status'],
            'role' => $_POST['role'],
        ];

        $is_upload = UserValidation::uploadAvatar();
        if ($is_upload) {
            $data['avatar'] = $is_upload;
        }
        // var_dump($data );
        // die;
        $result = $user->createUser($data);
        if ($result) {
            NotificationHelper::success('store', 'Thêm khách hàng thành công');
            header('location: /admin/users');
            exit();
        } else {
            NotificationHelper::error('store', 'Thêm khách hàng thất bại');
            header('location: /admin/users/create');
            exit();
        }
    }

    public static function edit(int $id)
    {
        AuthHelper::checkPermission([0]);
        $user = new User();
        $data = $user->getOneUser($id);
        if (!$data) {
            NotificationHelper::error('edit', 'Không thể xem người dùng này');
            header('location: /admin/users');
            exit;
        }
        // var_dump($data['avatar']);
// die;
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        // Hiển thị form sửa
        Edit::render($data);
        Footer::render();

        // if ($data) {
        //     Header::render();
        //     // hiển thị form sửa
        //     Edit::render($data);
        //     Footer::render();
        // } else {
        //     header('location: /admin/categories');
        // }
    }



    // // xử lý chức năng sửa (cập nhật)
    public static function update(int $id)
    {
        // Kiểm tra tính hợp lệ của dữ liệu
        $is_valid = UserValidation::edit();

        if (!$is_valid) {
            NotificationHelper::error('update', 'Cập nhật người dùng thất bại');
            header("location: /admin/users/$id");
            exit;
        }

        $user = new User();
        // var_dump($_POST);
// die;
// //         Chuẩn bị dữ liệu để cập nhật

        $data = [
            'username' => $_POST['username'],
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'avatar' => $_POST['avatar'],
            'address' => $_POST['address'],
            'status' => $_POST['status'],
            'role' => $_POST['role'],
        ];
        // var_dump($data);
// die;
        // Cập nhật mật khẩu chỉ khi có mật khẩu mới
        if ($_POST['password'] !== '') {
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        // Kiểm tra và cập nhật ảnh đại diện nếu tải lên thành công
        $is_upload = UserValidation::uploadAvatar();
        if ($is_upload) {
            $data['avatar'] = $is_upload;
        }

        // Thực hiện cập nhật người dùng
        $result = $user->updateUser($id, $data);

        if ($result) {
            NotificationHelper::success('update', 'Cập nhật người dùng thành công');
            header('location: /admin/users');
        } else {
            NotificationHelper::error('update', 'Cập nhật người dùng thất bại');
            header("location: /admin/users/$id");
            exit;
        }
    }



    // // thực hiện xoá
    public static function delete(int $id)
    {
        $user = new user();
        $is_exist = $user->getOneuser($id);
        if ($is_exist && $is_exist['id'] === $id) {
            $data = [
                'status' => 0,
            ];
            $result = $user->updateuser($id, $data);
        }
        if ($result) {
            NotificationHelper::success('delete_user', 'Xóa người dùng thành công!');
            header('Location: /admin/users');
        } else {
            NotificationHelper::error('delete_user', 'Xóa người dùng thất bại!');
            header("Location: /admin/users");
        }
    }
    public function userRecycle()
    {
        AuthHelper::checkPermission([0]);
        $user = new User();
        $data = $user->getAllUserByStatusRecycle();

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        UserRecycle::render($data);
        Footer::render();

    }
    public static function restore(int $id)
    {
        $user = new User();
        $is_exist = $user->getOneUser($id);
        if ($is_exist && $is_exist['id'] === $id) {
            $data = [
                'status' => 1,
            ];
            $result = $user->updateuser($id, $data);
        }
        if ($result) {
            NotificationHelper::success('restore_user', 'Khôi phục tài khoản thành công!');
            header('Location: /admin/recycle/users');
        } else {
            NotificationHelper::error('restore_user', 'Khôi phục tài khoản thất bại!');
            header("Location: /admin/recycle/users");
        }
    }
    public static function deletePermanently(int $id)
    {
        $user = new User();
        $is_exist = $user->getOneUser($id);
        if ($is_exist && $is_exist['id'] === $id) {
            $data = [
                'status' => 3,
            ];
            $result = $user->updateuser($id, $data);
        }
        if ($result) {
            NotificationHelper::success('deletePermanently_user', 'Xóa vĩnh viễn tài khoản thành công!');
            header('Location: /admin/recycle/users');
        } else {
            NotificationHelper::error('deletePermanently_user', 'Xóa vĩnh viễn tài khoản thất bại!');
            header("Location: /admin/recycle/users");
        }
    }

    public function searchUsers()
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

        $user = new User();
        $data = $user->search($keyword);

        Header::render();
        Index::render($data);
        Footer::render();
    }

    public static function history($id)
    {
        $_SESSION['user_id'] = $id;
        $order = new Order();
        $data = $order->getAllOrderbyUser_id_admin($id);
        Header::render();
        History::render($data);
        Footer::render();
    }

    public static function historyDetail(int $id)
    {

        AuthHelper::detail_history($id);
        $detail = new Order_detail();
        $data = $detail->getAllOrder_id_admin($id);
        // var_dump($data);
        // die;
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        History_detail::render($data);
        Footer::render();
    }
    public static function historyOrderStatus()
    {
       // $status = isset($_POST['status']) ? $_POST['status'] : 'all';
        $transport = 1;
        $user_id = 8;
    
        $detail = new Order();
        $data = $detail->getAllOrder_ByStatus($transport, $user_id); 
        var_dump($data);
        die;
        if ($status === 'all') {
            $data = $detail->getAll_($int, $user_id); // Lấy tất cả đơn hàng
        } else {
            $data = $detail->getAll_($int, $user_id); // Lấy tất cả đơn hàng
        }

        // Kiểm tra dữ liệu trước khi sử dụng foreach
        if (is_array($data) || is_object($data)) {
            foreach ($data as $item) {
                echo '<tr>';
                echo '<td>' . $item['id'] . '</td>';
                echo '<td>' . number_format($item['total']) . ' VND</td>';
                echo '<td>' . ($item['paymentMethod'] === "COD" ? 'Thanh toán khi nhận hàng' : 'VNPAY') . '</td>';
                echo '<td>' . $item['date'] . '</td>';
                echo '<td>' . ($item['orderStatus'] === "0" ? 'Chưa thanh toán' : 'Đã thanh toán') . '</td>';
                echo '<td>
                         <div class="dropdown">
                             <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                 <i class="bx bx-dots-vertical-rounded"></i>
                             </button>
                             <div class="dropdown">
                                 <div class="dropdown-menu">
                                     <a class="dropdown-item" href="/admin/users/history/detail/' . $item['id'] . '">
                                         <i class="bx bxs-cart"></i> Chi tiết Thanh toán
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="6">Không có đơn hàng nào phù hợp.</td></tr>';
        }
    }


}
