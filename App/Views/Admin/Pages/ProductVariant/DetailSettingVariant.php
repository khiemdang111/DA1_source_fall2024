<?php

namespace App\Views\Admin\Pages\ProductVariant;

use App\Views\BaseView;

class DetailSettingVariant extends BaseView
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
                  <h2 class="text-center"><?= $data[0]['product_name'] ?></h2>
                </div>
              </div>
              <div class="card-body pt-4">
                <form action="/admin/skus" id="" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="method" id="" value="POST">
                  <div class="row g-6">
                    <div class="col-md-12">
                      <label for="name" class="form-label">Tên <span class="text-danger"> *</span></label>
                      <input class="form-control" type="text" id="name" name="name" />
                    </div>
                    <div class="col-md-6">
                      <label for="image" class="form-label">Ảnh <span class="text-danger"> *</span></label>
                      <label for="file" class="custum-file-upload">
                        <div class="icon">
                          <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                fill=""></path>
                            </g>
                          </svg>
                        </div>
                        <div class="text">
                          <span>Click to upload image</span>
                        </div>
                        <input id="file" type="file" name="image">
                      </label>
                    </div>
                    <?php
                    function generateRandomCode($length = 12) {
                      $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; // Bộ ký tự có thể có
                      $charactersLength = strlen($characters); // Độ dài của bộ ký tự
                      $randomCode = '';
                  
                      // Duyệt qua số lần yêu cầu (10 lần cho mã dài 10 ký tự)
                      for ($i = 0; $i < $length; $i++) {
                          $randomIndex = random_int(0, $charactersLength - 1); // Chọn một vị trí ngẫu nhiên trong bộ ký tự
                          $randomCode .= $characters[$randomIndex]; // Thêm ký tự vào mã
                      }
                      return $randomCode;
                  }                 
                    ?>
                    <div class="col-md-6">
                      <label for="sku" class="form-label">Mã vạch<span class="text-danger"> *</span></label>
                      <input type="text" class="form-control" id="sku" name="sku" value="<?= generateRandomCode(10); ?>"/>
                    </div>
                    <div class="col-md-6">
                      <label for="price" class="form-label">Giá <span class="text-danger"> *</span></label>
                      <input type="text" class="form-control" id="price" name="price" placeholder="" />
                    </div>
                    <div class="col-md-12">
                      <label for="description" class="form-label">Mô tả <span class="text-danger"> *</span></label>
                      <textarea class="form-control" type="text" id="description" rows="5" name="description"
                        placeholder="Nhập mô tả"></textarea>
                    </div>
                    <input type="hidden" name="product_id" value="<?= $data[0]['product_id'] ?>">
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
