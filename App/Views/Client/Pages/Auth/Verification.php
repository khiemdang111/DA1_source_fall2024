<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;
use Mailer;

class Verification extends BaseView
{
    public static function render($data = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userCode = $_POST['verification_code'] ?? '';
            $sessionCode = $_SESSION['verification_code'] ?? null;
            $validTime = 300; // Thời hạn 5 phút

            if (!$sessionCode || time() - $_SESSION['verification_time'] > $validTime) {
                unset($_SESSION['verification_code'], $_SESSION['verification_time']);
                $error['fail'] = 'Mã xác nhận đã hết hạn!';
            } elseif ($userCode !== $sessionCode) {
                $error['fail'] = 'Mã xác nhận không hợp lệ!';
            } else {
                unset($_SESSION['verification_code'], $_SESSION['verification_time']);
                header('Location: /resetPassword');
                exit;
            }
        }
?>

        <section class="hero-wrap hero-wrap-2" style="background-image: url('<?= APP_URL ?>/public/assets/client/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-end justify-content-center">
                    <div class="col-md-9 ftco-animate mb-5 text-center">
                        <p class="breadcrumbs mb-0">
                            <span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span>
                            <span>Nhập Mã Xác Minh <i class="fa fa-chevron-right"></i></span>
                        </p>
                        <h2 class="mb-0 bread">Xác Minh</h2>
                    </div>
                </div>
            </div>
        </section>

        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">
                        <h3 class="text-center fw-bold mb-4">Nhập Mã Xác Minh</h3>
                        <form action="/VerificationAction" method="post" class="form">
                            <input type="hidden" name="method" value="POST">
                            <div class="mb-3">
                                <label for="verification_code" class="form-label">Mã xác minh</label>
                                <input type="text" name="number" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary w-100" type="submit">Gửi yêu cầu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>