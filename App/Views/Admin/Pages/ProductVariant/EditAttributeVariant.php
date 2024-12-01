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
                    <input type="hidden" name="table" value="product_variants">
                    <div class="col-md-12 mb-3">
                      <label for="variant_name" class="form-label">Thuộc tính</label>
                      <input type="hidden" name="variant_id" value="<?= $variant[0]['id'] ?>">
                      <input type="text" class="form-control" name="variant_name" id="variant_name"
                        value="<?= $variant[0]['name'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
                </form>
              </div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6 mt-3">
              <div class="card">
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <div class="dropdown-1">
                          <input hidden="" class="sr-only" name="state-dropdown" id="state-dropdown" type="checkbox" />
                          <label aria-label="dropdown scrollbar" for="state-dropdown" class="trigger"></label>
                          <ul class="list webkit-scrollbar" role="list" dir="auto">
                            <li class="listitem" role="listitem">
                              <form action="/addmin/add/optionname/<?= $variant[0]['id'] ?>" method="post">
                                <input type="hidden" name="method" value="POST">
                                <input type="hidden" name="product_variant_id" value="<?= $variant[0]['id'] ?>">
                                <label for="variant_name" class="form-label">Thuộc tính</label>
                                <input type="text" name="name" class="form-control" placeholder="Tên thuộc tính">
                                <button type="submit" class="btn btn-primary mt-3">Thêm</button>
                              </form>
                            </li>
                          </ul>
                        </div>
                      </tr>
                      <tr>
                        <th>Tên</th>
                        <th>Tùy chỉnh</th>
                      </tr>
                    </thead>

                    <tbody>
                      <input type="hidden" name="method" value="POST">
                      <?php
                      foreach ($option_name as $item):
                        ?>
                        <tr>
                          <th class="w-75">
                            <form class="" action="/admin/product-variant/update/<?= $item['variant_option_id'] ?>"
                              method="post" style="display: inline-block;">
                              <input type="hidden" name="method" value="POST" id="">
                              <input type="text" name="variant_name" class="form-control"
                                value="<?= $item['variant_option_name'] ?>">
                              <input type="hidden" name="table" value="product_variant_options">
                              <input type="hidden" name="variant_id" placeholder="" value="<?= $item['variant_option_id'] ?>">
                              <button type="submit" class="btn btn-primary mt-3">
                                Cập nhật</button>
                            </form>

                          </th>
                          <td>
                            <form class="w-20" action="/admin/delete/attributeVariant/<?= $item['variant_option_id'] ?>"
                              method="post" style="display: inline-block;"
                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                              <input type="hidden" name="method" value="POST" id="">
                              <input type="hidden" name="table" value="product_variant_options">
                              <input type="hidden" name="variant_id" value="<?= $item['variant_option_id'] ?>">
                              <button type="submit" class="btn btn-outline-danger">
                                <i class="bx bx-trash"></i></button>
                            </form>
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
