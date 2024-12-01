<?php 
namespace App\Controllers\Client;

use App\Controllers\Client\CartController;
use App\Helpers\CartHelper;
use App\Models\Bank;
use App\Models\VietQRModel;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Order\payment;

class PaymentController {

  
    public static function createQRCode() {
        $addInfo = 'ghi chú nha'; // SÔ TIỀN THNAH TOÁN
        $cart_data = CartController::getorder();
        $total = CartHelper::tatol($cart_data); // giá
        $banks = new Bank();
        $result = $banks->getAll_Client_Bank();
        // var_dump($result);
        // die;
        $vietQR = new VietQRModel();
        $response = $vietQR->generateQRCode( $result[0]['account_number'], $result[0]['account_name'], $result[0]['bank_code'], $addInfo, $total['total']);
        if (isset($response['data']["qrCode"])) {
            Header::render();
            payment::render($result);
            Footer::render();
            // echo "<img src='https://api.vietqr.io/image/".$result[0]['bank_code']."-" . $result[0]['account_number'] . "-DIpoq5P.jpg?accountName=" . $result[0]['account_name'] . "&amount=" . $total['total'] . "' alt='QR Code'width='25%' />";
        } else {
            echo "Lỗi: Không tạo được mã QR.";
        }
    }
}
