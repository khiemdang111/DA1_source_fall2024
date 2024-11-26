<?php
namespace App\Controllers\Client;

use App\Helpers\CartHelper;
use App\Models\GHTKModel;

class ShippingController
{




    public function createOrderGHTK()
    {
        $cart_data = CartController::getorder();
        $order = [
            'products' => []  // Khởi tạo mảng sản phẩm trống
        ];

        // Lặp qua giỏ hàng và xây dựng mảng sản phẩm
        foreach ($cart_data as $cart) {
            if ($cart['data']) {
                $weight = isset($cart['data']['weight']) ? $cart['data']['weight'] : 0.6;
                $product = [
                    'name' => $cart['data']['name'],
                    'weight' => $weight,
                    'quantity' => $cart['quantity'],
                    'product_code' => $cart['data']['id'],
                ];
                $order['products'][] = $product;
            }
        }
        if (empty($order['products'])) {
            echo "Lỗi: Đơn hàng không có sản phẩm!";
            return;
        }
        $total_vulue = CartHelper::tatol($cart_data);
        $order['order'] = [
            'id' => (string) $_SESSION['order_id'],
            'pick_name' => 'Wine Cần Thơ',
            'pick_address' => 'FPT Polytechnic',
            'pick_province' => 'TP.Cần Thơ',
            'pick_district' => 'Quận Cái Răng',
            'pick_ward' => 'Phường Thường Thạnh',
            'pick_tel' => '0901234567',
            'tel' => $_SESSION['information']['phone'],
            'name' => $_SESSION['information']['name'],
            'address' => $_SESSION['information']['address'],
            'province' => $_SESSION['information']['province'],
            'district' => $_SESSION['information']['district'],
            'ward' => $_SESSION['information']['ward'],
            'hamlet' => 'Khác',
            'is_freeship' => 1,
            'pick_money' => $total_vulue['total'],
            'note' => 'Giao giờ hành chính',
            'value' => $total_vulue['total'],
            'transport' => 'road',
        ];
        // echo '<pre>';
        // var_dump($order);
        // die;
        // Gửi yêu cầu API
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/order",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($order),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Token: ATo2Yp39vAKo3XErRxJZERRIisA4QIHqA4KgCE",
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        if ($data['success']) {
            if (!isset($_SESSION['information']['delivery'])) {
                echo "Tạo đơn hàng thành công! Booking ID: " . $data['order']['label'];

            } else {
                // trống nha
            }
        } else {
            echo "Lỗi: " . $data['message'];
            die;
        }
    }
   
    public function deleteOrderGHTK()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/cancel/{TRACKING_ORDER}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: ATo2Yp39vAKo3XErRxJZERRIisA4QIHqA4KgCE",
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo 'Response: ' . $response;

    }




}
