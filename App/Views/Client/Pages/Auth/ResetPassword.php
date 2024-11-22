<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;

class ResetPassword extends BaseView
{
    public static function render($data = null)
    {
?>


<section class="hero-wrap hero-wrap-2" style="background-image: url('<?= APP_URL ?>/public/assets/client/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Đặt lại mật khẩu <i class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Đặt lại mật khẩu</h2>
                </div>
            </div>
        </div>
    </section>
    <div class="container d-flex justify-content-center align-items-center">
        <!-- Reset Password -->
        <div class="mt-5 mb-5 col-xl-6">
            <div class="card px-sm-6 px-0">
                <div class="card-body">
                    <form id="formResetPassword" method="post" action="/updatePassword">
                        <input type="hidden" name="method" value="POST">
                        

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="new_password" name="new_password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"   />
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"  />
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Đặt lại mật khẩu</button>
                        </div>

                        <?php
                        if (isset($_SESSION['success_message'])) {
                            echo '<div class="alert alert-success mt-3">' . $_SESSION['success_message'] . '</div>';
                            unset($_SESSION['success_message']);
                        } elseif (isset($_SESSION['error_message'])) {
                            echo '<div class="alert alert-danger mt-3">' . $_SESSION['error_message'] . '</div>';
                            unset($_SESSION['error_message']);
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Reset Password -->
    </div>

<?php
    }
}
?>