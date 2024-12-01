<?php

namespace App\Views\Admin\Pages\ProductVariant;

use App\Views\BaseView;

class EditSku extends BaseView
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
                </div>
              </div>
              <div class="card-body pt-4">
                <form action="/update/sku/<?= $data[0]['id'] ?>" id="" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="method" id="" value="POST">
                  <div class="row g-6">
                    <div class="col-md-6">
                    <img src="<?= APP_URL ?>/public/uploads/products/<?= $data[0]['image'] ?>" width="200px" class="rounded mx-auto d-block" alt="...">
                    </div>
                    <div class="col-md-12">
                      <label for="name" class="form-label">Tên <span class="text-danger"> *</span></label>
                      <input class="form-control" type="text" id="name" name="name" value="<?= $data[0]['name'] ?>" />
                    </div>
                    <div class="col-md-6">
                      <label for="image" class="form-label">Ảnh <span class="text-danger"> *</span></label>
                      <input type="file" name="image" id="image">
                    </div>
                    <div class="col-md-6">
                      <label for="sku" class="form-label">Mã vạch<span class="text-danger"> *</span></label>
                      <input type="text" class="form-control" id="sku" name="sku_hidden" value="<?= $data[0]['sku'] ?>" />
                      <input type="hidden" name="sku" id="sku" value="<?= $data[0]['sku'] ?>">
                    </div>
                    <div class="col-md-6">
                      <label for="price" class="form-label">Giá <span class="text-danger"> *</span></label>
                      <input type="text" class="form-control" id="price" name="price" placeholder=""
                        value="<?= $data[0]['price'] ?>" />
                    </div>
                    <div class="col-md-12">
                      <label for="description" class="form-label">Mô tả <span class="text-danger"> *</span></label>
                      <textarea class="form-control" type="text" id="description" rows="5" name="description"
                        value=""><?= $data[0]['description'] ?></textarea>
                    </div>
                    <input type="hidden" name="id" value="<?= $data[0]['id'] ?>">
                  </div>
                  <div class="mt-6">
                    <button type="submit" class="btn btn-primary me-3" name>Lưu</button>
                    <button type="reset" class="btn btn-outline-secondary" name>Nhập lại</button>
                  </div>
                </form>
              </div>
              <!-- /Account -->
            </div>
          </div>
        </div>
      </div>
      <script>
        CKEDITOR.replace('description');


      </script>


      <?php
  }
}
