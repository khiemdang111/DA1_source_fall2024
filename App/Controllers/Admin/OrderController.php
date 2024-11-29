<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Models\Order;
use App\Models\User;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Order\delivering;
use App\Views\Admin\Pages\Order\SuccessfulDelivery;



class OrderController
{
    // lấy tất cả đơn hàng đặt đang giao 
    public static function index()
    {
        $order = new Order();
        $data = $order->getAllorder_admin(1);
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        delivering::render($data);
        Footer::render();
    }
    // lấy tất cả đơn hàng đặt giao thành công
    public static function success()
    {
        $order = new Order();
        $data = $order->getAllorder_admin(2);
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        SuccessfulDelivery::render($data);
        Footer::render();
    }

    public function shippingUpdates($id)
    {
        $order = new Order();

        // Cập nhật trạng thái giao hàng thành công
        $result = $order->transport($id);
        if ($result) {
            // Lấy thông tin đơn hàng dựa trên ID
            $order_data = $order->getOneorder($id);
            if ($order_data) {
                // Tính toán điểm tích lũy
                $pointsPerUnit = 10000; // 10,000 VNĐ = 1 điểm
                $total = $order_data['total']; // Tổng giá trị đơn hàng
                $earned_points = floor($total / $pointsPerUnit); // Làm tròn điểm

                // Cập nhật điểm tích lũy cho user
                $user_id = $order_data['user_id']; // Lấy user_id từ đơn hàng
                self::update_user_points($user_id, $earned_points);

                // Thông báo và chuyển hướng
                NotificationHelper::success('shippingUpdates', "Duyệt thành công và cộng {$earned_points} điểm cho user {$user_id}!");
            } else {
                NotificationHelper::error('shippingUpdates', 'Không tìm thấy đơn hàng để cập nhật điểm.');
            }

            header("Location: /admin/products/success");
        } else {
            NotificationHelper::error('shippingUpdates', 'Duyệt thất bại.');
            header("Location: /admin/order/delivering");
        }
    }


   
    public static function update_user_points($user_id, $earned_points)
    {
        $user = new User();
        $data_user = $user->getUserId($user_id); // Lấy thông tin user từ DB
    
      
        $new_points = $data_user['accumulate_points'] + $earned_points; // Cộng điểm mới
    
        try {
            $result = $user->updateUserPoints($user_id, $new_points); // Cập nhật điểm trong DB
            if ($result) {
                NotificationHelper::success('points', "User {$user_id} đã tích lũy thêm {$earned_points} điểm!");
                return true;
            }
        } catch (\Exception $e) {
            NotificationHelper::error('points', 'Không thể cập nhật điểm tích lũy: ' . $e->getMessage());
        }
    
        return false;
    }
    
}
