<?php

namespace App\Views\Client\Pages\Cart;

use App\Helpers\AuthHelper;
use App\Views\BaseView;

class Bill extends BaseView
{
    public static function render($data = null)
    {
        $hihi = number_format($_GET['vnp_Amount'] / 100);
        $date = date('Y-m-d H:i:s');
        
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        </head>
        <body>
            <div class="container w-50 my-5">
                <div class="">
                    <div class=" p-2 text-center">
                        <img src="/public/uploads/image/image.png" alt="" width="10%">
                        <h5 class="text-primary">Giao dịch thành công</h5>
                    </div>
                    <div class="container">
                        <div class="d-flex justify-content-between py-3 item_dflex">
                            <div class="item">Số điện thoại</div>
                            <div class="item"><?= $_SESSION['information']['phone'] ?></div>
                        </div>
                        <div class="d-flex justify-content-between py-3 item_dflex">
                            <div class="item">Thời gian thanh toán</div>
                            <div class="item"><?= $date ?></div>
                        </div>
                        <div class="d-flex justify-content-between py-3 item_dflex">
                            <div class="item">Phương thức thanh toán</div>
                            <div class="item"><?= $_SESSION['information']['PaymentMethod'] ?></div>
                        </div>
                        <div class="d-flex justify-content-between py-3 item_dflex">
                            <div class="item">Số tiền thanh toán</div>
                            <div class="item text-danger"><?= $hihi ?> VND</div>
                        </div>
                        <div class="d-flex justify-content-center py-3">
                            <a href="/" id="complete_header">Thực hiện giao dịch khác</a>
                        </div>
                    </div>
                </div>

            </div>
        </body>

        </html>
        <?php

    }
}