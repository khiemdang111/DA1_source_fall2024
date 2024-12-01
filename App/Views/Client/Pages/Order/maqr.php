<?php

namespace App\Views\Client\Pages\Order;


use App\Views\BaseView;
use App\Views\Client\Components\NavbarAccount;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Response\QrCodeResponse;

class maqr extends BaseView
{
    public static function render($data = null)
    {
        ?>
        <h2>Tạo mã QR thanh toán</h2>
        <form action="/taoqr" method="POST">
            <input type="hidden" name="method" value="POST">
            <label for="accountNo">Số tài khoản:</label>
            <input type="text" name="accountNo" required>
            <br>
            <label for="accountName">Tên tài khoản:</label>
            <input type="text" name="accountName" required>
            <br>
            <label for="acqId">Mã ngân hàng:</label>
            <input type="text" name="acqId" required>
            <br>
            <label for="addInfo">Thông tin bổ sung:</label>
            <input type="text" name="addInfo">
            <br>
            <label for="amount">Số tiền:</label>
            <input type="number" name="amount" required>
            <br>
            <input type="submit" value="Tạo mã QR">
        </form>
        <?php

    }
}