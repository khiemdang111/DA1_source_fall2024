<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;

class Login extends BaseView
{
  public static function render($data = null)
  {
?>

    <section class="hero-wrap hero-wrap-2" style="background-image: url('<?= APP_URL ?>/public/assets/client/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate mb-5 text-center">
            <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Đăng nhập <i class="fa fa-chevron-right"></i></span></p>
            <h2 class="mb-0 bread">Đăng Nhập</h2>
          </div>
        </div>
      </div>
    </section>
            <div class="container d-flex justify-content-center align-items-center  ">
               
                        <!-- Register -->
                         <div class=" mt-5 mb-5 col-xl-6 " >
                         <div class="card px-sm-6 px-0  ">
                            <div class="card-body">
                                <!-- Logo -->

                                <form id="formAuthentication" method="post" class="mb-6" action="">
                                <input type="hidden" name="method" value="POST">
                                    <div class="mb-3 ">
                                        <label for="username" class="form-label">Tên đăng nhập </label>
                                        <input type="text" class="form-control" id="username" name="username" value=""
                                            placeholder=" Nhập tên tài khoản ....." autofocus />
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <label class="form-label" for="password">Mật khẩu</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" />
                                           
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mt-8">
                                            <div class="form-check mb-0 ms-2">
                                                <input class="form-check-input" type="checkbox" id="remember" name="remember" />
                                                <label class="form-check-label" for="remember"> Ghi lại </label>
                                            </div>
                                            <p class="mb-0"><a href="/forgetpass" class="mr-2">Quên mật khẩu </a> </p>
                                            
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Đăng nhập</button>
                                    </div>

                                    <div class="mb-3 d-flex justify-content-center ">
                                        or
                                    </div>
                                    <div class="mb-2 d-flex justify-content-center border border-dark-subtle ">
                                    <a href="/login-google"><img src="<?=getenv(APP_URL)?>/public/assets/client/images/google.png" alt="" width="60px" class="mr-3">Đăng nhập bằng GooGle</a>
                                        
                                    </div>

                                    <?php
                      if (isset($_SESSION['success_message'])) {
                        echo '<div class="alert alert-success mt-3">' . $_SESSION['success_message'] . '</div>';
                      } elseif (isset($_SESSION['error_message'])) {
                        echo '<div class="alert alert-danger mt-3">' . $_SESSION['error_message'] . '</div>';
                        unset($_SESSION['error_message']);
                      }
                      ?>
                                </form>

                              
                            </div>
                        </div>
                         </div>
                      
                        <!-- /Register -->
            
            </div>

           
<?php
  }
}
