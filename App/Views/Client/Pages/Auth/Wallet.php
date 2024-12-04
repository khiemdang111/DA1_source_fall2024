<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;

class Wallet extends BaseView
{
  public static function render($data = null)
  {
    ?>
    <?php
    if (isset($_SESSION['check_password']) && $_SESSION['check_password'] == true):
      ?>
      <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-xl-5 col-lg-6 col-md-8">
          <div class="card shadow-lg p-4 border-0 rounded-4">
            <div class="text-center mb-4">
              <h2 class="fw-bold">Số dư trong ví của bạn là: <strong><?= number_format($data['balance'], 0, '', '.') ?></strong></h2>
            </div>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-xl-5 col-lg-6 col-md-8">
          <div class="card shadow-lg p-4 border-0 rounded-4">
            <div class="text-center mb-4">
              <h2 class="fw-bold">Nhập mật khẩu</h2>
            </div>
            <div class="text-right">
              <form action="/checkuser/wallet" method="post">
                <input type="hidden" name="method" value="POST">
                <input type="text" class="form-control" name="password_user" placeholder="Mật khẩu tài khoản">
                <button class="btn btn-primary mt-3">Gửi</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php
    endif;
    // unset($_SESSION['check_password']);
  ?>
  <?php
  }
}
