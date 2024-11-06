<?php

namespace App\Views\Admin\Pages\Auth;

use App\Views\BaseView;

class Login extends BaseView
{
    public static function render($data = null)
    {
?>
        <!doctype html>

        <html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
            data-assets-path="./assets/" data-template="vertical-menu-template-free" data-style="light">

        <head>
            <meta charset="utf-8" />
            <meta name="viewport"
                content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

            <title> Login </title>

            <meta name="description" content="" />

            <!-- Favicon -->
            <link rel="icon" type="image/x-icon" href="<?= APP_URL ?>/public/assets/admin/assets/img/favicon/favicon.ico" />

            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
            <link
                href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
                rel="stylesheet" />

            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/admin/assets/vendor/fonts/boxicons.css" />

            <!-- Core CSS -->
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/admin/assets/vendor/css/core.css" class="template-customizer-core-css" />
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/admin/assets/css/demo.css" />

            <!-- Vendors CSS -->
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

            <!-- Page CSS -->
            <!-- Page -->
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/admin/assets/vendor/css/pages/page-auth.css" />
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/admin/assets/css/demo.css" />


            <!-- Helpers -->
            <script src="<?= APP_URL ?>/public/assets/admin/assets/vendor/js/helpers.js"></script>
            <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
            <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
            <script src="../public<?= APP_URL ?>/public/assets/admin/assets/js/config.js"></script>
        </head>

        <body>
            <!-- Content -->

            <div class="container-xxl">
                <div class="authentication-wrapper authentication-basic container-p-y">
                    <div class="authentication-inner">
                        <!-- Register -->
                        <div class="card px-sm-6 px-0">
                            <div class="card-body">
                                <!-- Logo -->
                                <div class="app-brand justify-content-center">
                                    <a href="#" class="app-brand-link gap-2">
                                        <span class="app-brand-text demo text-heading fw-bold">ADMIN</span>
                                    </a>
                                </div>
                           

                                <form id="formAuthentication" method="post" class="mb-6" action="">

                                    <div class="mb-6">
                                        <label for="email" class="form-label">Email </label>
                                        <input type="text" class="form-control" id="email" name="email" value=""
                                            placeholder="Enter your email" autofocus />

                                    </div>
                                    <div class="mb-6 form-password-toggle">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" />
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>



                                    </div>
                                    <div class="mb-8">
                                        <div class="d-flex justify-content-between mt-8">
                                            <div class="form-check mb-0 ms-2">
                                                <input class="form-check-input" type="checkbox" id="remember-me" />
                                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                                    </div>
                                </form>

                              
                            </div>
                        </div>
                        <!-- /Register -->
                    </div>
                </div>
            </div>

            <script src="<?= APP_URL ?>/public/assets/admin/assets/vendor/libs/jquery/jquery.js"></script>
            <script src="<?= APP_URL ?>/public/assets/admin/assets/vendor/libs/popper/popper.js"></script>
            <script src="<?= APP_URL ?>/public/assets/admin/assets/vendor/js/bootstrap.js"></script>
            <script src="<?= APP_URL ?>/public/assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
            <script src="<?= APP_URL ?>/public/assets/admin/assets/vendor/js/menu.js"></script>

            <!-- endbuild -->

            <!-- Vendors JS -->

            <!-- Main JS -->
            <script src="<?= APP_URL ?>/public/assets/admin/assets/js/main.js"></script>

            <!-- Page JS -->

            <!-- Place this tag before closing body tag for github widget button. -->
            <script async defer src="https://buttons.github.io/buttons.js"></script>
        </body>

        </html>

<?php
    }
}
