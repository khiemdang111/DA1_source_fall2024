<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class Edit extends BaseView
{
  public static function render($data = null)
  {
?>
    <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-6">
              <!-- Account -->
              <div class="card-body">
                <div class="">
                  <h2 class="text-center">Cập nhật sản phẩm dfhjk</h2>
                </div>
              </div>
              <div class="card-body pt-4">
                <form action="/admin/update/<?= $data['product']['id'] ?>" id="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="method" id="" value="PUT">
                  <div class="row g-6">
                  <div class="col-md-12">
                      <label for="name" class="form-label">Tên <span class="text-danger"> *</span></label>
                      <input value="<?= $data['product']['id'] ?>" class="form-control" type="text" id="name" name="name" disabled/>
                    </div>
                    <div class="col-md-12">
                      <label for="name" class="form-label">Tên <span class="text-danger"> *</span></label>
                      <input value="<?= $data['product']['name'] ?>" class="form-control" type="text" id="name" name="name"  />
                    </div>
                    <div class="col-md-12">
                      <label for="avatar" class="form-label">Ảnh <span class="text-danger"> *</span></label>
                      <input value="" class="form-control" type="file" id="avatar" name="avatar" />
                    </div>
                    <div class="col-md-6">
                      <label for="price" class="form-label">Giá gốc <span class="text-danger"> *</span></label>
                      <input value="<?= $data['product']['price'] ?>" type="text" class="form-control" id="price" name="price" />
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="discount_price">Giá giảm</label>
                      <div class="input-group input-group-merge">
                        <input value="<?= $data['product']['discount_price'] ?>" type="text" id="discount_price" name="discount_price" class="form-control" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="date" class="form-label">Ngày-tháng-năm <span class="text-danger"> *</span></label>
                      <input value="<?= $data['product']['date'] ?>" type="date" class="form-control" id="birthday" name="date" placeholder="Address" />
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="is_featured">Nổi bật <span class="text-danger"> *</span></label>
                      <select name="is_featured" class="select2 form-select">
                        <option value="">Vui lòng chọn...</option>
                        <option value="1" <?php if ($data['product']['is_featured'] == 1) echo 'selected="selected"'; ?>>Nổi bật</option>
                        <option value="0" <?php if ($data['product']['is_featured'] == 0) echo 'selected="selected"'; ?>>Bình thường</option>
                      </select>
                    </div>
                    <div class="col-md-12">
                      <label for="description" class="form-label">Mô tả <span class="text-danger"> *</span></label>
                      <textarea class="form-control" type="text" id="description" rows="5" name="description"
                        placeholder="Nhập mô tả"><?= $data['product']['description'] ?></textarea>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="category_id">Danh mục <span class="text-danger"> *</span></label>
                      <select name="category_id" class="select2 form-select">
                      <option value="">Vui lòng chọn ...</option>
                        <?php
                        foreach ($data['category'] as $item) :
                        ?>
                          <option value="<?= $item['id'] ?>" <?= ($item['id'] == $data['product']['category_id']) ? 'selected' : ''  ?>><?= $item['name'] ?></option>
                        <?php
                        endforeach;
                        ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="ogirin_id" class="form-label">Thương hiệu <span class="text-danger"> *</span></label>
                      <select id="ogirin_id" class="select2 form-select">
                        <option value="">Chọn thương hiệu</option>
                        <option value="en">English</option>
                        <option value="fr">French</option>
                        <option value="de">German</option>
                        <option value="pt">Portuguese</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="status" class="form-label">Trạng thái <span class="text-danger"> *</span></label>
                      <select name="status" class="select2 form-select">
                      <option value="1" <?php if ($data['product']['status'] == 1) echo 'selected="selected"'; ?>>Hiển thị</option>
                      <option value="2" <?php if ($data['product']['status'] == 2) echo 'selected="selected"'; ?>>Ẩn</option>
                      </select>
                    </div>
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
