<?php

namespace App\Views\Admin\Pages\ProductVariant;

use App\Views\BaseView;

class CreateAttributeVariant extends BaseView
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
                <h4>Tất cả các thuộc tính</h4>
              </div>
              <div class="card-body pt-4">
                <form action="/admin/productvariant" id="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="method" id="" value="POST">
                  <div class="row g-6">
                    <div class="col-5 col-md-5 col-xl-5">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Tên</th>
                            <th>Thành phần</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody id="multi_properties">
                          <?php
                          // Mảng để nhóm các option_name theo name
                          $grouped_data = [];

                          // Nhóm dữ liệu
                          foreach ($data as $item) {
                            $name = $item['name'];
                            if (!isset($grouped_data[$name])) {
                              $grouped_data[$name] = [];
                            }
                            $grouped_data[$name][] = $item['option_name'];
                          }

                          // Hiển thị bảng
                          foreach ($grouped_data as $name => $option_names):
                            ?>
                            <tr class="items_properties">
                              <input type="hidden">
                              <td scope="row">
                                <?= $name ?>
                              </td>
                              <td>
                                <?= implode(', ', $option_names) // Hiển thị danh sách option_name, cách nhau bởi dấu phẩy ?>
                              </td>
                              <td>
                                <div class="d-flex justify-content-center">
                                  <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                      data-bs-toggle="dropdown">
                                      <i class="bx bx-edit-alt"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                      <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop" href="/admin/productvariant/<?= $item['id'] ?>">
                                        Thuộc tính</button>
                                      <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop" href="/admin/products/<?= $item['id'] ?>">Thành
                                        phần</button>
                                    
                                    </div>
                                  </div>
                                  <!-- Button trigger modal -->
                                  <form class="" action="/admin/delete/products/<?= $item['id'] ?>" method="post"
                                    style="display: inline-block;" onsubmit="return confirm('Chắc chưa?')">
                                    <input type="hidden" name="method" value="POST" id="">
                                    <button class="dropdown-item w-20"><i class="bx bx-trash me-1"></i> </button>
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
                    <div class="col-7 col-md-7 col-xl-7">
                      <div class="card">
                        <!-- Account -->
                        <div class="card-body">
                          <h4 class="text-center">Thêm thuộc tính</h4>
                        </div>
                        <div class="card-body pt-4">
                          <form action="/admin/addAttribute" id="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="method" id="" value="POST">
                            <div class="row g-6">
                              <input type="hidden" name="product_id" value="<?= $data[0]['product_id'] ?>">
                              <div class="col-md-12">
                                <label for="product_variant_name" class="form-label">Tên thuộc tính<span
                                    class="text-danger"> *</span></label>
                                <input class="form-control" type="text" id="product_variant_name"
                                  name="product_variant_name" placeholder="VD: màu, kích thước" />
                              </div>
                              <div class="col-md-12">
                                <label for="product_variant_value" class="form-label">Giá trị<span class="text-danger">
                                    *</span></label>
                                <input class="form-control" type="text" id="product_variant_value"
                                  name="product_variant_value" placeholder="VD: lớn, trung bình, nhỏ..." />
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
