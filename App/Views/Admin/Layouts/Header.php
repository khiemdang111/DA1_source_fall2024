<?php

namespace App\Views\Admin\Layouts;

use App\Views\BaseView;

class Header extends BaseView
{
    public static function render($data = null)
    {

?>
       <!doctype html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= APP_URL ?>/public/assets/admin/assets/"
  data-template="vertical-menu-template-free"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Demo : Dashboard - Analytics | sneat - Bootstrap Dashboard PRO</title>

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
    <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/admin/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?= APP_URL ?>/public/assets/admin/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= APP_URL ?>/public/assets/admin/assets/js/config.js"></script>
  </head>

        <body>

            <!-- ============================================================== -->
            <!-- Main wrapper - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
                <!-- ============================================================== -->
                <!-- Topbar header - style you can find in pages.scss -->
                <!-- ============================================================== -->
                <header class="topbar" data-navbarbg="skin5">
                    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                        <div class="navbar-header" data-logobg="skin5">

                            <!-- ============================================================== -->
                            <!-- Logo -->
                            <!-- ============================================================== -->
                            <a class="navbar-brand" href="/admin">
                                <!-- Logo icon -->
                                <b class="logo-icon ps-2">
                                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                    <!-- Dark Logo icon -->
                                    <img src="<?= APP_URL ?>/public/assets/admin/images/logo-icon.png" alt="homepage" class="light-logo" />

                                </b>
                                <!--End Logo icon -->
                                <!-- Logo text -->
                                <span class="logo-text">
                                    <!-- dark Logo text -->
                                    <img src="<?= APP_URL ?>/public/assets/admin/images/logo-text.png" alt="homepage" class="light-logo" />

                                </span>
                                <!-- Logo icon -->
                                <!-- <b class="logo-icon"> -->
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                <!-- <img src="<?= APP_URL ?>/public/assets/admin/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                                <!-- </b> -->
                                <!--End Logo icon -->
                            </a>
                            <!-- ============================================================== -->
                            <!-- End Logo -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- Toggle which is visible on mobile only -->
                            <!-- ============================================================== -->
                            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </div>
                        <!-- ============================================================== -->
                        <!-- End Logo -->
                        <!-- ============================================================== -->
                        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                            <!-- ============================================================== -->
                            <!-- toggle and nav items -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav float-start me-auto">
                                <li class="nav-item d-none d-lg-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                                <!-- ============================================================== -->
                            </ul>
                            <!-- ============================================================== -->
                            <!-- Right side toggle and nav items -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav float-end">                
                                <!-- ============================================================== -->
                                <!-- User profile and search -->
                                <!-- ============================================================== -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="<?= APP_URL ?>/public/assets/admin/images/users/1.jpg" alt="user" class="rounded-circle" width="31">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href=""><i class="fa fa-power-off me-1 ms-1"></i> Đăng xuất</a>
                                    </ul>
                                </li>
                                <!-- ============================================================== -->
                                <!-- User profile and search -->
                                <!-- ============================================================== -->
                            </ul>
                        </div>
                    </nav>
                </header>
                <!-- ============================================================== -->
                <!-- End Topbar header -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Left Sidebar - style you can find in sidebar.scss  -->
                <!-- ============================================================== -->
                <aside class="left-sidebar" data-sidebarbg="skin5">
                    <!-- Sidebar scroll-->
                    <div class="scroll-sidebar">
                        <!-- Sidebar navigation-->
                        <nav class="sidebar-nav">
                            <ul id="sidebarnav" class="pt-4">
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Thống kê</span></a>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Loại sản phẩm </span></a>
                                    <ul aria-expanded="false" class="collapse  first-level">
                                        <li class="sidebar-item">
                                            <a href="/admin/categories" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Danh sách </span></a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="/admin/categories/create" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Thêm mới </span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Sản phẩm </span></a>
                                    <ul aria-expanded="false" class="collapse  first-level">
                                        <li class="sidebar-item">
                                            <a href="/admin/products" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Danh sách </span></a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="/admin/products/create" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Thêm mới </span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Bình luận </span></a>
                                    <ul aria-expanded="false" class="collapse  first-level">
                                        <li class="sidebar-item">
                                            <a href="/admin/comments" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Danh sách </span></a>
                                        </li>
                                    </ul>
                                </li>

            <li class="menu-item">
              <a href="icons-boxicons.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div class="text-truncate" data-i18n="Boxicons">Boxicons</div>
              </a>
            </li>

            <!-- Forms & Tables -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Forms &amp; Tables</span></li>
            <!-- Forms -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div class="text-truncate" data-i18n="Form Elements">Form Elements</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="forms-basic-inputs.html" class="menu-link">
                    <div class="text-truncate" data-i18n="Basic Inputs">Basic Inputs</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="forms-input-groups.html" class="menu-link">
                    <div class="text-truncate" data-i18n="Input groups">Input groups</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div class="text-truncate" data-i18n="Form Layouts">Form Layouts</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="form-layouts-vertical.html" class="menu-link">
                    <div class="text-truncate" data-i18n="Vertical Form">Vertical Form</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="form-layouts-horizontal.html" class="menu-link">
                    <div class="text-truncate" data-i18n="Horizontal Form">Horizontal Form</div>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Form Validation -->
            <li class="menu-item">
              <a
                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/form-validation.html"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-check"></i>
                <div class="text-truncate" data-i18n="Form Validation">Form Validation</div>
                <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
              </a>
            </li>
            <!-- Tables -->
            <li class="menu-item">
              <a href="tables-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div class="text-truncate" data-i18n="Tables">Tables</div>
              </a>
            </li>
            <!-- Data Tables -->
            <li class="menu-item">
              <a
                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/tables-datatables-basic.html"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-grid"></i>
                <div class="text-truncate" data-i18n="Datatables">Datatables</div>
                <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
              </a>
            </li>
            <!-- Misc -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
            <li class="menu-item">
              <a
                href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div class="text-truncate" data-i18n="Support">Support</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div class="text-truncate" data-i18n="Documentation">Documentation</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

      

           

        <?php

    }
}

        ?>