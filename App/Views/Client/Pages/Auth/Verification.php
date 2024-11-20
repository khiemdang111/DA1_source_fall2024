<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;
use Mailer;

class Forgetpass extends BaseView
{
    public static function render($data = null)
    {
       
?>
        <section class="hero-wrap hero-wrap-2" style="background-image: url('<?= APP_URL ?>/public/assets/client/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-end justify-content-center">
                    <div class="col-md-9 ftco-animate mb-5 text-center">
                        <p class="breadcrumbs mb-0">
                            <span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span>
                            <span> Nhập Mã xác nhận  <i class="fa fa-chevron-right"></i></span>
                        </p>
                        <h2 class="mb-0 bread">Mã xác nhận </h2>
                    </div>
                </div>
            </div>
        </section>

        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">
                        <h3 class="text-center fw-bold mb-4">Quên mật khẩu</h3>
                        <form action="/Verification" method="post" id="formDemo" class="form">
                            <?php
                            if (isset($_POST['submit'])) {
                                $error = array();
                                if ($_POST['text'] != $_SESSION['code']) {
                                    $error['fail'] = 'Mã xác nhận không hợp lệ!';
                                } else {
                                    header('Location: /register');
                                    exit;
                                }
                            }
                            ?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control <?php if (isset($error['email'])) echo 'is-invalid'; ?>" name="email" placeholder="Nhập email">
                                <?php if (isset($error['email'])): ?>
                                    <div class="invalid-feedback">
                                        <?= $error['email']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary w-100" type="submit" name="submit">Gửi yêu cầu</button>
                            </div>
                        </form>
                        <?php if (isset($error['fail'])): ?>
                            <div class="alert alert-danger text-center mt-3">
                                <?= $error['fail']; ?>
                            </div>
                        <?php endif; ?>
                        <div class="text-center mt-4">
                            <p>Bạn chưa có tài khoản? <a href="/register" class="text-primary fw-bold">Đăng ký</a></p>
                            <p>Hoặc <a href="/login" class="text-primary fw-bold">Đăng nhập</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
?>