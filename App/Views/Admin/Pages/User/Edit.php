<?php

namespace App\Views\Admin\Pages\User;

use App\Views\BaseView;

class Edit extends BaseView
{
    public static function render($data = null)
    {
        // var_dump($data);
        // die;
?>

        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">QUẢN LÝ NGƯỜI DÙNG</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Sửa tài khoản người dùng</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body">
                                <h4 class="card-title">Sửa tài khoản người dùng</h4>
                                <div align="center">
                                </div>
                                <div class="card-body pt-4">
                                    <form class="form-horizontal" action="/update/user/<?= $data['id'] ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="method" id="" value="PUT">
                                        <!-- <input type="hidden" name="method" id="" value="POST"> -->
                                        <div class="row g-6">
                                        <div class="col-md-12">
                                                <label for="avatar" class="form-label">Ảnh đại diện<span class="text-danger"> *</span></label>
                                                <input type="hidden" name="avatar"value="<?= $data['avatar'] ?>" >
                                                <img src="<?= APP_URL ?>/public/assets/admin/assets/img/avatars/<?= $data['avatar'] ?>" alt="Avatar" class="rounded mx-auto d-block"  />
                                            </div>
                                            <div class="col-md-12">
                                                <label for="id" class="form-label">ID <span class="text-danger"> *</span></label>
                                                <input class="form-control bg-secondary bg-gradient" type="text" id="id" name="id" value="<?= $data['id'] ?>" readonly  />
                                            </div>
                                            <div class="col-md-12">
                                                <label for="name" class="form-label">Họ và Tên <span class="text-danger"> *</span></label>
                                                <input class="form-control bg-secondary bg-gradient" type="text" id="name" name="name" value="<?= $data['name'] ?>"  readonly/>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="username" class="form-label">Tên đăng nhập<span class="text-danger"> *</span></label>
                                                <input class="form-control bg-secondary bg-gradient" type="text" id="username" name="username" value="<?= $data['username'] ?>"  readonly/>
                                            </div>
                                         
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Số điện thoại </label>
                                                <input type="text" class="form-control bg-secondary bg-gradient" id="phone" name="phone" value="<?= $data['phone'] ?>"readonly  />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="email">Email <span class="text-danger"> *</span></label>
                                                <div class="input-group input-group-merge">
                                                    <input type="email" id="email" name="email" value="<?= $data['email'] ?>" class="form-control bg-secondary bg-gradient"  readonly/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Mật khẩu <span class="text-danger"> *</span></label>
                                                <input type="password" class="form-control bg-secondary bg-gradient" id="password" name="password" placeholder="*********" readonly />
                                            </div>
                                            <!-- <div class="col-md-6">
                                                <label class="form-label" for="re_password">Nhập lại mật khẩu <span class="text-danger"> *</span></label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="re_password" name="re_password" class="form-control bg-secondary bg-gradient" placeholder="*********"  />
                                                </div>
                                            </div> -->
                                            <div class="col-md-12">
                                                <label for="address" class="form-label">Địa chỉ </label>
                                                <textarea class="form-control bg-secondary bg-gradient" type="text" id="address" rows="5" name="address" 
                                                    placeholder="Nhập địa chỉ"><?= $data['address'] ?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="status" class="form-label">Trạng thái<span class="text-danger"> *</span></label>
                                                <select id="status" class="select2 form-select" name="status">
                                                    <option value="">Chọn trạng thái</option>
                                                    <option value="1" <?= $data['status'] == 1 ? 'selected' : '' ?>>Kích hoạt</option>
                                                    <option value="2" <?= $data['status'] == 0 ? 'selected' : '' ?>>Khóa</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="role" class="form-label">Quyền <span class="text-danger"> *</span></label>
                                                <select id="role" class="select2 form-select" name="role">
                                                    <option value="">Chọn quyền</option>
                                                    <option value="0" <?= $data['role'] == 0 ? 'selected' : '' ?>>Quản trị</option>
                                                    <option value="1" <?= $data['role'] == 1 ? 'selected' : '' ?>>Khách hàng</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="border-top">
                                            <div class="card-body">
                                                <button type="reset" class="btn btn-danger text-white" name="">Làm lại</button>
                                                <button type="submit" class="btn btn-primary" name="">Cập nhật</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->

    <?php
    }
}
