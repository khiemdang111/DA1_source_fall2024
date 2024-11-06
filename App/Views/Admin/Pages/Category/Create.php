<?php

namespace App\Views\Admin\Pages\Category;

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
                    <h2 class="text-center">Thêm mới danh mục sản phẩm</h2>
                  </div>
                </div>
                <div class="card-body pt-4">
                  <form action="/admin/categories" id="" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="method" id="" value="POST">
                    <div class="row g-6">
                      <div class="col-md-12">
                        <label for="name" class="form-label">Tên <span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" id="name" name="name" autofocus />
                      </div>
                        <div class="col-md-12 mb-3">
                        <label for="discription" class="form-label">Mô tả <span class="text-danger"> *</span></label>
                        <textarea class="form-control" type="text" id="discription" rows="5" name="discription"
                          placeholder="Nhập mô tả"></textarea>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="status" class="form-label">Trạng thái<span class="text-danger"> *</span></label>
                        <select id="status" class="select2 form-select">
                          <option value="">Chọn thương hiệu</option>
                          <option value="en">English</option>
                          <option value="fr">French</option>
                          <option value="de">German</option>
                          <option value="pt">Portuguese</option>
                        </select>
                      </div>
                      <div class="col-md-12 mt-6">
                      <button type="submit" class="btn btn-primary me-3" name>Lưu</button>
                      <button type="reset" class="btn btn-outline-secondary" name>Nhập lại</button>
                    </div>
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
