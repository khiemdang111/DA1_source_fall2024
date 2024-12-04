<?php

namespace App\Views\Client\Pages\Order;

use App\Controllers\Client\CartController;
use App\Helpers\CartHelper;
use App\Views\BaseView;
use App\Views\Client\Components\NavbarAccount;

class payment extends BaseView
{
    public static function render($data = null)
    {
        $cart_data = CartController::getorder();
        $total = CartHelper::tatol($cart_data);
        ?>
        <h1>Đếm ngược</h1>
        <p id="countdown"></p>
        <div class="container text-center">
            <h3 class="text-center m-2">Thông tin đơn hàng</h3>
            <h6 class="text-center m-2 text-danger">Cảm ơn bạn đã đặt hàng tại Wine Cần Thơ .Vui lòng kiểm tra đơn hàng trước
                khi thanh toán</h6>

            <div class="d-flex justify-content-center">
                <div class="item_banks px-5">Mã đơn hàng :</div>
                <div class="item_banks px-5">Ngày đặt</div>
                <div class="item_banks px-5">Tổng tiền</div>
                <div class="item_banks px-5">Phương thức thanh toán chuyển khoản</div>
            </div>
            <h2 class="text-center mt-4">Mã QR chuyển khoản ngân hàng</h2>
            <img src='https://api.vietqr.io/image/<?= $data[0]['bank_code'] ?>-<?= $data[0]['account_number'] ?>-DIpoq5P.jpg?accountName=<?= $data[0]['account_name'] ?>&amount=<?= $total['total'] ?>'
                alt='QR Code' width='45%' />" ;
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            // Thời gian đếm ngược (ví dụ: 5 phút từ thời điểm hiện tại)
            let countdownTime = 10;  // 5 phút (300 giây)

            function updateCountdown() {
                let minutes = Math.floor(countdownTime / 60);
                let seconds = countdownTime % 60;
                // Hiển thị thời gian còn lại
                document.getElementById("countdown").innerHTML = `${minutes} phút ${seconds} giây`;

                if (countdownTime <= 0) {
                    clearInterval(countdownInterval);  // Dừng đếm ngược khi hết thời gian
                    sendPostRequest();  // Gọi hàm PHP khi hết thời gian
                } else {
                    countdownTime--;
                }
            }

            // Gọi hàm updateCountdown mỗi giây
            let countdownInterval = setInterval(updateCountdown, 1000);
            function sendPostRequest() {
                $.ajax({
                    url: '/huydon',  // Địa chỉ file PHP xử lý
                    method: 'POST',
                    data: { 
                        action: 'timeout',
                        method:"POST",
                     },  // Dữ liệu gửi đi
                    success: function (response) {
                        alert('Hết thời gian! PHP đã xử lý yêu cầu.');
                        window.location.href = '/';
                    },
                    error: function (error) {
                        alert('Đã có lỗi xảy ra.');
                    }
                });
            }
        </script>
        <?php
    }
}