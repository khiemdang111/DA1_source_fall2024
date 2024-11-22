<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;
use Google\Service\CloudTrace\Span;
use Mailer;

class Forgetpass extends BaseView
{
  public static function render($data = null)
  {
    // include_once './App/Email/Index.php';
    // $mail = new Mailer;
?>

    <section class="hero-wrap hero-wrap-2" style="background-image: url('<?= APP_URL ?>/public/assets/client/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate mb-5 text-center">
            <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Quên mật khẩu <i class="fa fa-chevron-right"></i></span></p>
            <h2 class="mb-0 bread">Quên mật khẩu </h2>
          </div>
        </div>
      </div>
    </section>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="col-xl-5 col-lg-6 col-md-8">
    <div class="card shadow-lg p-4 border-0 rounded-4">
      <div class="text-center mb-4">
        <h3 class="fw-bold">Quên mật khẩu</h3>
        <p class="text-muted">Nhập email của bạn để nhận mã xác nhận</p>
      </div>
      <form action="/mail" method="post">
        <input type="hidden" name="method" value="POST">
        
        <?php
        if (isset($_SESSION['error_message'])) {
          echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
          unset($_SESSION['error_message']);
        } elseif (isset($_SESSION['success_message'])) {
          echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
          unset($_SESSION['success_message']);
        }
        ?>
        
        <div class="mb-3">
          <label for="username" class="form-label">Tên đăng nhập</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
        </div>
        <div class="d-grid">
          <button class="btn btn-primary" type="submit" name="submit">Gửi yêu cầu</button>
        </div>
      </form>
      <div class="text-center mt-4">
        <p class="mb-1">Bạn chưa có tài khoản? <a href="/register" class="text-primary fw-semibold">Đăng ký</a></p>
        <p class="mb-0">Hoặc <a href="/login" class="text-primary fw-semibold">Đăng nhập</a></p>
      </div>
    </div>
  </div>
</div>


<?php
  }
}
