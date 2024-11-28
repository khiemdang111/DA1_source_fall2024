<?php

namespace App\Helpers;

use App\Controllers\Client\CartController;
use App\Controllers\Client\GHTKController;
use App\Controllers\Client\mail;
use App\Controllers\Client\MailController;
use App\Controllers\Client\ShippingController;
use App\Controllers\Client\VNPAYController;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\User;
use App\Views\Client\Components\Formmail;


class CartHelper
{
    public static function tatol($cart_data)
    {
        $total = 0;
        $i = 0;
        foreach ($cart_data as $cart) {
            if ($cart['data']) {
                if ($cart['data']['discount_price'] > 0) {
                    $money = $cart['quantity'] * $cart['data']['discount_price'];
                    $unitPrice = $cart['data']['discount_price'];
                    $total += $money;
                } else {
                    $money = $cart['quantity'] * $cart['data']['price'];
                    $unitPrice = $cart['data']['price'];
                    $price = 0;
                    $total += $money;
                }
                if (isset($_SESSION['unit'])) { 
                    $unit = floatval($total) - floatval($_SESSION['unit']);
                } else {
                    $unit =  $total;
                }
                $data_total = [
                    'total' => $unit,
                ];
            }
        }

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
        if ($_SESSION['information']['PaymentMethod'] === "COD") {
            $orderStatus = 0;
        } else {
            $orderStatus = 1;
        }
        $total = self::tatol($cart_data);
        $date = date('Y-m-d');
        $oders = [
            'total' => $total['total'],
            'orderStatus' => $orderStatus,
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

        foreach ($cart_data as $cart) {
            if ($cart['data']) {

                // $price = self::tatol($cart_data);
                if ($cart['data']['discount_price'] > 0) {
                    $money = $cart['quantity'] * $cart['data']['discount_price'];
                    $price = $cart['data']['price'];
                    $unitPrice = $cart['data']['discount_price'];
                } else {
                    $money = $cart['quantity'] * $cart['data']['price'];
                    $unitPrice = $cart['data']['price'];
                    $price = 0;
                }
                $order_detail = [
                    'quantity' => $cart['quantity'],
                    'originalPrice' => $price,
                    'unitPrice' => $unitPrice,
                    'totalPrice' => $money,
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
        if (isset($_POST['delivery'])) {
            $delivery = $_POST['delivery']; 
            if ($delivery == 'conomy') {
                $GHTK = new ShippingController();
                $GHTK->createOrderGHTK();
            } elseif ($delivery == 'fast') {
                $GHTK = new ShippingController();
                $GHTK->createOrderGHN();
            } else {
                echo "Loại giao hàng không hợp lệ.";
            }
        } else {
            if ($_SESSION['information']['delivery'] == 'conomy') {
                $GHTK = new ShippingController();
                $GHTK->createOrderGHTK();
            } elseif ($_SESSION['information']['delivery'] == 'fast') {
                $GHTK = new ShippingController();
                $GHTK->createOrderGHN();
            } else {
                echo "Loại giao hàng không hợp lệ.";
            }
        }
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
                $total = 0;
                $i++;
                $name = $cart['data']['name'];
                $quantity = $cart['quantity'];
                if ($cart['data']['discount_price'] > 0) {
                    $money = $cart['quantity'] * $cart['data']['discount_price'];

                    $unitPrice = $cart['data']['discount_price'];
                    $total += $money;
                } else {
                    $money = $cart['quantity'] * $cart['data']['price'];
                    $unitPrice = $cart['data']['price'];
                    $price = 0;
                    $total += $money;
                }
                $total_price_formatted = number_format($money) . " VND";
                $unit_price = number_format($unitPrice) . " VND";
                $total = number_format($total) . " VND";
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


