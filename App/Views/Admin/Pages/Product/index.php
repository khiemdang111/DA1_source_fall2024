<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class index extends BaseView
{
  public static function render($data = null)
  {
?>


    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
          <h5 class="card-header">Table Basic</h5>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 15px">Id</th>
                  <th>Tên</th>
                  <th>Hình ảnh</th>
                  <th>Giá</th>
                  <th>Trạng thái</th>
                  <th>Tùy chỉnh</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                <?php
                foreach ($data as $item):
                ?>
                  <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><img src="<?= APP_URL ?>/public/uploads/products/<?= $item['image'] ?>" alt="" width="100px"></td>

                    <td><?= number_format($item['price']) ?></td>
                    <td><?= ($item['status'] == 1) ? 'Hiển thị' : 'Ẩn' ?></td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="/admin/productvariant/<?= $item['id'] ?>"><i class="bx bx-cog me-1"></i> Cấu hình</a>
                          <a class="dropdown-item" href="/admin/products/<?= $item['id'] ?>"><i class="bx bx-edit-alt me-1"></i> Sửa</a>
                          <form class="w-100" action="/admin/delete/products/<?= $item['id'] ?>" method="post" style="display: inline-block;" onsubmit="return confirm('Chắc chưa?')">
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
        <!--/ Basic Bootstrap Table -->

        <hr class="my-12" />

        <!-- Bootstrap Dark Table -->
       
        <!--/ Bootstrap Dark Table -->
      </div>


  <?php
  }
}
