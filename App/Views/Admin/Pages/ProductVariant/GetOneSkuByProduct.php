<?php

namespace App\Views\Admin\Pages\ProductVariant;

use App\Views\BaseView;

class GetOneSkuByProduct extends BaseView
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
        <div class="card mb-3">
          <h5 class="card-header">Danh sách sản phẩm</h5>
          <div class="card-body">
            <!-- Basic Breadcrumb -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="javascript:void(0);">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="javascript:void(0);">Danh sách sản phẩm</a>
                </li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="card">
          <!-- <h5 class="card-header">Table Basic</h5> -->
          <div class="card-header">
          </div>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead class="table-light">
                <tr>
                  <th style="width: 15px">Id</th>
                  <th>Tên</th>
                  <th>Hình ảnh</th>
                  <th>Giá</th>
                  <th>Mã sản phẩm</th>
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
                    <td><?= $item['price'] ?></td>
                    <td><?= $item['sku'] ?></td>
                    <input type="hidden" name="status" value="<?= $item['status'] ?>">
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="/admin/edit/sku/<?= $item['id'] ?>"><i
                              class="bx bx-edit-alt me-1"></i> Sửa</a>
                          <form class="w-100" action="/admin/delete/sku/<?= $item['id'] ?>" method="post"
                            style="display: inline-block;">
                            <input type="hidden" name="method" value="POST">
                            <button class="dropdown-item delete-button button-del">
                              <i class="bx bx-trash me-1"></i> Xóa
                            </button>
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
        <div class="row my-5 justify-content-center">
        </div>
        <hr class="my-12" />

        <!-- Bootstrap Dark Table -->

        <!--/ Bootstrap Dark Table -->
      </div>


      <?php
  }
}
