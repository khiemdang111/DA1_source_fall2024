<?php

namespace App\Views\Admin\Pages\ProductVariant;

use App\Views\BaseView;

class EditAttributeVariant extends BaseView
{
  public static function render($data = null)
  {
    ?>
    <div class="content-wrapper">
      <!-- Content -->
      <?php
      $variant = $data['variant'];
      $option_name = $data['option_name'];
      ?>
      <div class="container-xxl  flex-grow-1 container-p-y">
        <div class="row">
          <div class="col-md-12 m-auto">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h3 class="text-center">Sửa thuộc tính</h3>
                </div>
                <div class="card-body pt-4">
                  <form action="/admin/product-variant/update/<?= $variant[0]['id'] ?>" method="post">
                    <input type="hidden" name="method" value="POST">
                    <div class="col-md-12 mb-3">
                      <label for="variant_name" class="form-label">Thuộc tính</label>
                      <input type="text" class="form-control" name="variant_name" id="variant_name"
                        value="<?= $variant[0]['name'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <button type="reset" class="btn btn-secondary">Nhập lại</button>
                </div>
                </form>
              </div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-4 mt-3">
              <div class="card">
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Tên</th>
                        <th class="" style="width: 40%">Tùy chỉnh</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      foreach ($option_name as $item):
                        ?>
                        <tr>
                          <th><?= $item['variant_option_name'] ?></th>
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="/admin/products/<?= $item['id'] ?>"><i
                                    class="bx bx-edit-alt me-1"></i> Sửa</a>
                                <form class="w-100" action="/admin/delete/products/<?= $item['id'] ?>" method="post"
                                  style="display: inline-block;" onsubmit="return confirm('Chắc chưa?')">
                                  <input type="hidden" name="method" value="POST" id="">
                                  <button class="dropdown-item"><i class="bx bx-trash me-1"></i> Xóa</button>
                                </form>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <?php
                      endforeach;
                      ?>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>
          </div>
          <?php
  }
}
