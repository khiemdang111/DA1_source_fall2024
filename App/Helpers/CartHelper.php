<?php

namespace App\Helpers;

use App\Controllers\Client\mail;
use App\Controllers\Client\MailController;
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
        $total_price = 0;
        $i = 0;
        foreach ($cart_data as $cart) {
            if ($cart['data']) {
                $i++;
                if ($cart['data']['discount_price'] > 0) {
                    $unit_price = $cart['quantity'] * $cart['data']['discount_price'];
                    $total_price += $unit_price;
                } else {
                    $unit_price = $cart['quantity'] * $cart['data']['price'];
                    $total_price += $unit_price;
                }
            }
        }
        return $total_price;
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
        $total_price = 0;
        $total = self::tatol($cart_data);
        $date = date('Y-m-d');
        // var_dump($date);
        // die();
        $oders = [
            'total' => $total,
            'orderStatus' => 1,
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'date' => $date,
            'PaymentMethod' => $_POST['PaymentMethod'],
            'user_id' => $user_id,
        ];
        $oder = new Order();
        $id_order = $oder->createOder($oders);

        $getOneOder_id = $oder->getOneCodeDetail($id_order);

        return $getOneOder_id['id'];
    }
    public static function createCart($cart_data)
    {
        // $code_oder = rand(0, 999);
        $order_id = self::getOrder_id($cart_data);
        $i = 0;
        foreach ($cart_data as $cart) {
            if ($cart['data']) {
                $i++;
                if ($cart['data']['discount_price'] > 0) {
                    $unit_price = $cart['quantity'] * $cart['data']['discount_price'];
                    $unitPrice = $cart['data']['discount_price'];
                } else {
                    $unit_price = $cart['quantity'] * $cart['data']['price'];
                    $unitPrice = $cart['data']['price'];
                }
                $order_detail = [
                    'product_id' => $cart['data']['id'],
                    'quantity' => $cart['quantity'],
                    'unitPrice' => $unitPrice,
                    'totalPrice' => $unit_price,
                    'order_id' => $order_id,
                ];
                $oder = new Order_detail();
                $result = $oder->createorderDetail($order_detail);
            }
        }
        $mail = new MailController();
        $form = self::form();
        $mail->index($form);
        if ($result) {
            setcookie('cart', '', time() - (3600 * 24 * 30 * 12), '/');
            NotificationHelper::success('update_products', 'Đặt hàng thành công!');
            header('Location: /');
        } else {
            NotificationHelper::error('update_products', 'Đặt hàng thất bại!');
            header("Location: /");
        }

        // echo 'vô';
    }


    public static function form()
    {
        
        if (isset($_COOKIE['cart'])) {
            $product = new Product();
            $cookie_data = $_COOKIE['cart'];
            $cart_data = json_decode($cookie_data, true);
            if (count($cart_data)) {
                foreach ($cart_data as $key => $value) {
                    $product_id = $value['product_id'];
                    $result = $product->getOneProduct($product_id);
                    $cart_data[$key]['data'] = $result;
                }
                $hihi = self::form_Html($cart_data);
            }
        } else {
            // $_SESSION['error'] = 'Giỏ hàng trống. Vui lòng thêm sản phẩm vào';
            NotificationHelper::error('cart', 'Giỏ hàng trống. Vui lòng thêm sản phẩm vào');
            header('location: /');
            // var_dump($_SESSION['error']);
        }
        return $hihi;
    }

    public static function form_Html($data)
    {

        $sđt = $_POST['phone'];
        $total_price = 0;
        $i = 0;
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
        <h2>Thông tin đơn hàng</h2>
        <table>
            <thead>
HTML;
        // Thêm vào biến HTML
        $html .= <<<ROW
                <table>
                 <thead>
              <tr>
                  <th>STT </th>
                  <th>Số điện thoại</th>
                  <th>Tên sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Ngày đặt</th>
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
                if ($cart['data']['discount_price'] > 0) {
                    $price = $cart['quantity'] * $cart['data']['discount_price'];
                    $total_price += $price;
                    $unit_price = number_format($cart['data']['discount_price']) . " VND";
                } else {
                    $price = $cart['quantity'] * $cart['data']['price'];
                    $total_price += $price;
                    $unit_price = number_format($cart['data']['price']) . " VND";
                }
                $total_price_formatted = number_format($price) . " VND";
                $total = number_format($total_price) . " VND";
                $html .= <<<ROW2
            <tr>
                <td>{$i}</td>
                <td>{$sđt}</td>
                <td>{$name}</td>
                <td>{$quantity}</td>
                <td>{$date}</td>
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
                    
                    <td colspan="5" class="total">Tổng cộng</td>
                    <td colspan="2" class="total">{$total} VND</td>
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
