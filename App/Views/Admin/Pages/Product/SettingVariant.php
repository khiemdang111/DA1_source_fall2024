<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class SettingVariant extends BaseView
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
                  <h2 class="text-center">Tạo biến thể</h2>
                </div>
              </div>
              <div class="card-body pt-4">
                <form action="/admin/productvariant" id="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="method" id="" value="POST">
                  <div class="row g-6">
<<<<<<< HEAD
                    <input type="hidden" name="id" value="<?= $data['product'][0]['id'] ?>">
=======
                    <input type="hidden" name="id" value="<?= $data['product'][0]['id']?>">
>>>>>>> b77ae48 ([admin] form add product variant)
                    <div class="col-md-12">
                      <img src="<?= APP_URL ?>/public/uploads/products/<?= $data['product'][0]['image'] ?>" width="200px"
                        class="rounded mx-auto d-block" alt="">
                    </div>
                    <div class="col-md-6">
                      <label for="name" class="form-label">Tên <span class="text-danger"> *</span></label>
                      <input value="<?= $data['product'][0]['name'] ?>" class="form-control" type="text" id="name" name="name" />
                    </div>


                    <div class="col-md-6">
                      <label for="category_name" class="form-label">Danh mục <span class="text-danger"> *</span></label>
                      <input value="<?= $data['product'][0]['category_name'] ?>" type="category_name" class="form-control"
                        id="category_name" name="category_name" placeholder="Address" />
                    </div>
<<<<<<< HEAD
                    <table class="table table-striped">
                      <div class="row mt-3 mb-3 justify-content-between">
                        <a href="javascript:void(0)" onclick="create()" class="btn btn-primary btn-sm"
                        style="width: 100px">Thêm hàng</a>
                      <a href="/admin/variant/add" class="btn btn-primary" style="width: 200px">Thêm thuộc tính</a>
                      </div>
                      
                      <thead>
                        <tr>
                          <th style="width: 20px" scope="col">#</th>
                          <?php
                          foreach ($data['variant'] as $itemVariant):
                            ?>
                            <th value="<?= $itemVariant['product_variant_id'] ?>">
                              <?= $itemVariant['product_variant_name'] ?>
                            </th>
                            <?php
                          endforeach;
                          ?>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody id="multi_properties">
                        <tr class="items_properties">
                          <th scope="row">1</th>
                          <?php
                          $processed_ids = []; // Mảng để theo dõi các pro_variant_id đã xử lý
// Khởi tạo mảng lưu trữ giá trị option_vl_name
                          foreach ($data['variant_opt'] as $itemVariant_opt):
                            if (in_array($itemVariant_opt['pro_variant_id'], $processed_ids)) {
                              // Bỏ qua nếu pro_variant_id đã tồn tại
                              continue;
                            }
                            // Thêm pro_variant_id vào danh sách đã xử lý
                            $processed_ids[] = $itemVariant_opt['pro_variant_id'];
                            ?>
                            <td value="<?= $itemVariant_opt['pro_variant_id'] ?>">
                              <?php
                              foreach ($data['variant_opt'] as $itemVariant_value):

                                if ($itemVariant_value['pro_variant_id'] === $itemVariant_opt['pro_variant_id']):
                                  // Chỉ hiển thị nếu pro_variant_id khớp
                                  ?>
                                  <div class="form-check w-50"> <!-- Checkbox input -->
                                    <input class="form-check-input" type="checkbox" value="<?= $itemVariant_value['id'] ?>"
                                      id="flexCheckChecked" name="option_vl_name[]">

                                    <!-- Input ẩn để gửi pro_variant_id -->
                                    <input type="hidden" name="pro_variant_id[]"
                                      value="<?= $itemVariant_opt['pro_variant_id'] ?>">

                                    <label class="form-check-label" for="flexCheckChecked">
                                      <?= $itemVariant_value['name'] ?>
                                    </label>
                                  </div>
                                  <?php
                                endif;
                              endforeach;
                              ?>

                            </td>
                            <?php
                          endforeach;
                          ?>
                          <td>
                            <label for="">&nbsp;</label>
                            <a href="javascript:void(0)" onclick="delete_(this)"
                              class="btn btn-danger btn-sm d-block w-50">Xóa</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
=======
                    <div class="form-group">
                      <label for="">Thuộc tính</label>
                      <a href="javascript:void(0)" onclick="create()" class="btn btn-primary btn-sm ">ADD</a>
                      <div id="multi_properties">
                        <div class="row items_properties row align-items-center">
                          <div class="col-3 mt-2">
                            <label for="">Tên thuộc tính</label>
                            <select name="product_variant_name[]" id="" class="form-select">
                              <option value="">Chọn thuộc tính</option>
                              <?php
                              foreach ($data['variant'] as $itemVariant):
                                ?>
                                <option value="<?= $itemVariant['product_variant_id'] ?>">
                                  <?= $itemVariant['product_variant_name'] ?>
                                </option>
                                <?php
                              endforeach;
                              ?>
                              </option>
                            </select>
                          </div>
                          <div class="col-3  mt-2">
                            <label for="option_vl_name">Giá trị</label>
                            <input type="text" class="form-control" id="option_vl_name" name="option_vl_name[]"
                              placeholder="Giá trị">
                          </div>
                          <div class="col-3  mt-2">
                            <label for="option_vl_price">Tiền</label>
                            <input type="text" class="form-control" id="option_vl_price" name="option_vl_price[]"
                              placeholder="Giá trị">
                          </div>
                          <div class="col-1">
                            <label for="">&nbsp;</label>
                            <a href="javascript:void(0)" onclick="delete_(this)"
                              class="btn btn-danger btn-sm d-block">Xóa</a>
                          </div>
                        </div>
                      </div>
                    </div>
>>>>>>> b77ae48 ([admin] form add product variant)
                  </div>
                  <div class="mt-6">
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
    <script>
      CKEDITOR.replace('description');
    </script>
    <script>
      function create() {
        let count_items = document.querySelectorAll(".items_properties").length - 1;
        count_items++;
<<<<<<< HEAD

        $("#multi_properties").append(`
                                                                                                        <tr class="items_properties">
                                          <th scope="row">${count_items + 1}</th>
                                          <?php
                                          $processed_ids = []; // Mảng để theo dõi các pro_variant_id đã xử lý
// Khởi tạo mảng lưu trữ giá trị option_vl_name
                                          foreach ($data['variant_opt'] as $itemVariant_opt):
                                            if (in_array($itemVariant_opt['pro_variant_id'], $processed_ids)) {
                                              // Bỏ qua nếu pro_variant_id đã tồn tại
                                              continue;
                                            }
                                            $processed_ids[] = $itemVariant_opt['pro_variant_id'];
                                            ?>
                                                    <td value="<?= $itemVariant_opt['pro_variant_id'] ?>">
                                                    <?php
                                                    foreach ($data['variant_opt'] as $itemVariant_value):
                                                      if ($itemVariant_value['pro_variant_id'] === $itemVariant_opt['pro_variant_id']):
                                                        ?>
                                                <div class="form-check w-50">
                                                                                     <input class="form-check-input" type="checkbox" value="<?= $itemVariant_value['id'] ?>"
                                                          id="flexCheckChecked" name="option_vl_name[]">

                                                        <!-- Input ẩn để gửi pro_variant_id -->
                                                        <input type="hidden" name="pro_variant_id[]"
                                                          value="<?= $itemVariant_opt['pro_variant_id'] ?>">

                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        <?= $itemVariant_value['name'] ?>
                                                    </label>
                                                </div>
                                                <?php
                                                      endif;
                                                    endforeach;
                                                    ?>

                                                    </td>
                                                    <?php
                                          endforeach;
                                          ?>
                                          <td>
                                            <label for="">&nbsp;</label>
                                            <a href="javascript:void(0)" onclick="delete_(this)"
                                              class="btn btn-danger btn-sm d-block w-50">Xóa</a>
                                          </td>
                                        </tr>                                                     `);
=======
        $("#multi_properties").append(`
                                                    <div class="row items_properties mt-3">
                                                        <div class="col-3">
                                                            <label for="">Tên thuộc tính</label>
                                                            <select name="product_variant_name" id="" class="form-select">
                                                                <option value="">Chọn thuộc tính</option>
                                                                <?php
                                                                foreach ($data['variant_data'] as $itemVariant):
                                                                  ?>
                                            <option value="<?= $itemVariant['product_variant_id'] ?>">
                                              <?= $itemVariant['product_variant_name'] ?>
                                            </option>
                                            <?php
                                                                endforeach;
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="option_vl_name">Giá trị</label>
                                                            <input type="text" class="form-control" id="option_vl_name" name="option_vl_name[]" placeholder="Giá trị">
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="option_vl_price">Giá</label>
                                                            <input type="text" class="form-control" id="option_vl_price" name="option_vl_price[]" placeholder="Giá trị">
                                                        </div>
                                                        <div class="col-1">
                                                            <label for="">&nbsp;</label>
                                                            <a href="javascript:void(0)" onclick="delete_(this)" class="btn btn-danger btn-sm d-block">Xóa</a>
                                                        </div>
                                                    </div>
                                                `);
>>>>>>> b77ae48 ([admin] form add product variant)
      }

      function delete_(__this) {
        let count_items = document.querySelectorAll(".items_properties").length - 1;
        count_items--;
        $(__this).closest(".items_properties").remove();
      }
    </script>
    <?php
  }
}
