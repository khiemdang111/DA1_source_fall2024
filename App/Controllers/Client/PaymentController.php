<?php
namespace App\Controllers\Client;

use App\Controllers\Client\CartController;
use App\Helpers\CartHelper;
use App\Models\Bank;
use App\Models\VietQRModel;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Layouts\Headerpay;
use App\Views\Client\Pages\Order\payment;
use App\Helpers\NotificationHelper;
use App\Models\Order;
class PaymentController
{


    public static function createQRCode()
    {
        $addInfo = 'ghi chú nha';
        $cart_data = CartController::getorder();
        $total = CartHelper::tatol($cart_data); // giá
        $banks = new Bank();
        $result = $banks->getAll_Client_Bank();
        $vietQR = new VietQRModel();
        $response = $vietQR->generateQRCode($result[0]['account_number'], $result[0]['account_name'], $result[0]['bank_code'], $addInfo, $total['total']);
        if (isset($response['data']["qrCode"])) {
            Headerpay::render();
            payment::render($result);
            Footer::render();
        } else {
            echo "Lỗi: Không tạo được mã QR.";
        }
    }
    public static function cancelOrder()
    {
      $order_id = $_SESSION['order_id'];
      $orders = new Order();
      $result = $orders->getOne_OrderByStatus($order_id); 
      $result['id'];
      if($result['transport'] === 4){
        $data = [
            'transport' => 0,
        ];
        $orders->update($result['id'],$data);
        setcookie('cart', '', time() - (3600 * 24 * 30 * 12), '/');
    }
    }
}
