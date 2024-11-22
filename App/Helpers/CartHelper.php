<?php

namespace App\Helpers;

use App\Controllers\Client\CartController;
use App\Controllers\Client\mail;
use App\Controllers\Client\MailController;
use App\Controllers\Client\VNPAYController;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\User;
use App\Views\Client\Components\Formmail;


class CartHelper
{
    // hàm lấy tổng giá đơn hàng
    public static function tatol($cart_data)
    {
        $total = 0;
        $i = 0;
        foreach ($cart_data as $cart) {
            if ($cart['data']) {
                $i++;
                if ($cart['data']['discount_price'] > 0) {
                    $money = $cart['quantity'] * $cart['data']['discount_price'];
                    $unitPrice = $cart['data']['discount_price'];
                    $total += $money;
                } else {
                    $money = $cart['quantity'] * $cart['data']['price'];
                    $unitPrice = $cart['data']['price'];
                    $total += $money;
                }
            }
        }
        $data_total = [
            'money' => $money,
            'unitPrice' => $unitPrice,
            'total' => $total,

        ];
        return $data_total;
    }

    public static function getOrder_id($cart_data)
    {
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user']['id'];
        }
        if (isset($_COOKIE['user'])) {
            $user_COOKIE = json_decode($_COOKIE['user'], true);
            $user_id = $user_COOKIE['id'];
        }
        $total = self::tatol($cart_data);
        $date = date('Y-m-d');
        $oders = [
            'total' => $total['total'],
            'orderStatus' => 1,
            'name' => $_SESSION['information']['name'],
            'phone' => $_SESSION['information']['phone'],
            'province' => $_SESSION['information']['province'],
            'district' => $_SESSION['information']['district'],
            'ward' => $_SESSION['information']['ward'],
            'address' => $_SESSION['information']['address'],
            'date' => $date,
            'PaymentMethod' => $_SESSION['information']['PaymentMethod'],
            'user_id' => $user_id,
        ];
        $oder = new Order();
        $id_order = $oder->createOder($oders);
        return $id_order;
    }
    public static function createCart($cart_data)
    {

        $order_id = self::getOrder_id($cart_data);
        $_SESSION['order_id'] = $order_id;
        $i = 0;
        foreach ($cart_data as $cart) {
            if ($cart['data']) {
                $i++;
                $price = self::tatol($cart_data);
                $order_detail = [
                    'quantity' => $cart['quantity'],
                    'unitPrice' => $price['unitPrice'],
                    'totalPrice' => $price['money'],
                    'product_id' => $cart['data']['id'],
                    'order_id' => $order_id,
                ];
                $oder = new Order_detail();
                $result = $oder->createorderDetail($order_detail);
            }
        }
        $mail = new MailController();
        $form = self::form_Html();
        $mail->index($form);
        if ($result) {
            setcookie('cart', '', time() - (3600 * 24 * 30 * 12), '/');
        } else {
            NotificationHelper::error('update_products', 'Đặt hàng thất bại!');
            header("Location: /");
        }
        // echo 'vô';
    }
    public static function form_Html()
    {
        $data = CartController::getorder();
        $phone = $_SESSION['information']['phone'];
        $address = $_SESSION['information']['address'] . " " . $_SESSION['information']['ward'] . " " . $_SESSION['information']['district'] . " " . $_SESSION['information']['province'];

        $i = 0;
        $stt = 1;
        $fullname = $_SESSION['information']['name'];
        $date = date("d/m/Y H:i:s");
        // Tạo biến chứa HTML và PHP
        $html = <<<HTML
<html>
    <head>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            th {
                background-color: #f2f2f2;
            }
            .total {
                font-weight: bold;
                text-align: right;
            }
        </style>
    </head>
    <body>


        
HTML;
        $html .= <<<ROW
        <h2>Thông tin đơn hàng của {$fullname}</h2>
          <table>
            <thead>
                 <tr>STT</th>
                  <th>Tên Người đặt </th>
                  <th>Số điện thoại</th>
                  <th>Ngày đặt</th>
                  <th>Địa chỉ</th>
                   </tr>
             </thead>
            <tbody>
               <tr>
                <td>{$stt}</td>
                <td>{$fullname}</td>
                <td>{$phone}</td>
                <td>{$date}</td>
                <td>{$address}</td>
               </tr>
             </tbody>
        </table>
   </br>

        <table>
            <thead>
               <tr>
                  <th>STT</th>
                  <th>Tên sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Đơn giá</th>
                  <th>Thành tiền</th>
              </tr>
          </thead>
        <tbody>

ROW;
        foreach ($data as $cart) {
            if ($cart['data']) {
                $i++;
                $name = $cart['data']['name'];
                $quantity = $cart['quantity'];
                $tatol = self::tatol($data);
                $total_price_formatted = number_format($tatol['money']) . " VND";
                $unit_price = number_format($tatol['unitPrice']) . " VND";
                $total = number_format($tatol['total']) . " VND";
                $html .= <<<ROW2
            <tr>
                <td>{$i}</td>
                <td>{$name}</td>
                <td>{$quantity}</td>
                <td>{$unit_price}</td>
                <td>{$total_price_formatted}</td>
            </tr>
ROW2;
            }
        }
        $html .= <<<FOOTER
           </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="total">Tổng cộng</td>
                    <td colspan="2" class="total">{$total} </td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
FOOTER;
        // Xuất nội dung
        return $html;
    }
}


