<?php

namespace App\Controllers\Admin;
use App\Helpers\NotificationHelper;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Models\Order;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Order\index;
use App\Views\Client\Pages\Order\index as OrderIndex;

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
        index::render($data );
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
        index::render($data );
        Footer::render();
    }
}
