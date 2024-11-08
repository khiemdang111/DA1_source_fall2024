<?php

namespace App\Views\Admin\Pages\User;


use App\Views\BaseView;

class Create extends BaseView
{
  public static function render($data = null)
  {
?>

    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-6">
              <!-- Account -->
              <div class="card-body">
                <div class="">
                  <h2 class="text-center">Thêm mới khách hàng</h2>
                </div>
              </div>
              <div class="card-body pt-4">
                <form action="/admin/users" id="" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="method" id="" value="POST">
                  <div class="row g-6">
                    <div class="col-md-12">
                      <label for="name" class="form-label">Họ và Tên <span class="text-danger"> *</span></label>
                      <input class="form-control" type="text" id="name" name="name" autofocus />
                    </div>
                    <div class="col-md-12">
                      <label for="username" class="form-label">Tên đăng nhập<span class="text-danger"> *</span></label>
                      <input class="form-control" type="text" id="username" name="username" autofocus />
                    </div>
                    <div class="col-md-12">
                      <label for="avatar" class="form-label">Ảnh đại diện<span class="text-danger"> *</span></label>
                      <input class="form-control" type="file" id="avatar" name="avatar" />
                    </div>
                    <div class="col-md-6">
                      <label for="phone" class="form-label">Số điện thoại </label>
                      <input type="text" class="form-control" id="phone" name="phone" />
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="email">Email <span class="text-danger"> *</span></label>
                      <div class="input-group input-group-merge">
                        <input type="email" id="email" name="email" class="form-control" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="password" class="form-label">Mật khẩu <span class="text-danger"> *</span></label>
                      <input type="password" class="form-control" id="password" name="password" />
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="re_password">Nhập lại mật khẩu <span class="text-danger"> *</span></label>
                      <div class="input-group input-group-merge">
                        <input type="password" id="re_password" name="re_password" class="form-control" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="address" class="form-label">Địa chỉ </label>
                      <textarea class="form-control" type="text" id="address" rows="5" name="address"
                        placeholder="Nhập địa chỉ"></textarea>
                    </div>
                    <div class="col-md-6">
                      <label for="status" class="form-label">Trạng thái<span class="text-danger"> *</span></label>
                      <select id="status" class="select2 form-select" name="status">
                        <option value="">Chọn trạng thái</option>
                        <option value="1">Kích hoạt</option>
                        <option value="0">Không kích hoạt</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="role" class="form-label">Quyền <span class="text-danger"> *</span></label>
                      <select id="role" class="select2 form-select" name="role">
                        <option value="">Chọn quyền</option>
                        <option value="0">Quản trị</option>
                        <option value="1">Khách hàng</option>
                      </select>
                    </div>
                  </div>
                  <div class="mt-6">
                    <button type="submit" class="btn btn-primary me-3" name>Thêm</button>
                    <button type="reset" class="btn btn-outline-secondary" name>Nhập lại</button>
                  </div>
                </form>
              </div>
              <!-- /Account -->
            </div>
          </div>
        </div>
      </div>

  <?php
  }
}
