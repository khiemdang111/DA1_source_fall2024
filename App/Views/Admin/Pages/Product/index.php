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
            <form action="/admin/products/search" method="get">
              <div class="input-group input-group-merge">
                <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                <input type="text" class="form-control" name="keywords"
                  value="<?= (isset($_SESSION['keywords']) ? $_SESSION['keywords'] : "") ?>" placeholder="Tìm kiếm"
                  aria-label="Tìm kiếm" aria-describedby="basic-addon-search31" />
              </div>

            </form>
          </div>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead class="table-light">
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
                          <a class="dropdown-item" href="/admin/productvariant/<?= $item['id'] ?>"><i
                              class="bx bx-cog me-1"></i> Cấu hình</a>
                          <a class="dropdown-item" href="/admin/products/<?= $item['id'] ?>"><i
                              class="bx bx-edit-alt me-1"></i> Sửa</a>
                          <form class="w-100" action="/admin/delete/products/<?= $item['id'] ?>" method="post"
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

        <hr class="my-12" />

        <!-- Bootstrap Dark Table -->

        <!--/ Bootstrap Dark Table -->
      </div>


      <?php
  }
}
