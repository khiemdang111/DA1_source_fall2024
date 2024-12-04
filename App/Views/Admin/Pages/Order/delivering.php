<?php

namespace App\Views\Admin\Pages\Order;

use App\Views\BaseView;

class delivering extends BaseView
{
  public static function render($data = null)
  {
    // echo '<pre>';
    // var_dump($data);
    // die;
?>
    <div class="container-xxl flex-grow-1 container-p-y">
      <!-- Basic Bootstrap Table -->
      <div class="card mb-3">
        <h5 class="card-header">Danh sách đơn hàng đang giao</h5>
        <div class="card-body">
          <!-- Basic Breadcrumb -->
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="javascript:void(0);">Dashboard</a>
              </li>
              <li class="breadcrumb-item">
                <a href="javascript:void(0);">Danh sách đơn hàng đang giao</a>
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
                <th>Tên khách hàng</th>
                <th>Số tiền thanh toán</th>
                <th>Số điện thoại</th>
                <th>Ngày Mua</th>
                <th>Địa chỉ</th>
                <th></th>
                <th></th>




              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              <?php
              foreach ($data as $item):
                $data_adress = $item['address'] . " " . $item['ward'] . " " . $item['district'] . " " . $item['province'];

              ?>
                <tr>
                  <td><?= $item['id'] ?></td>
                  <td><?= $item['name'] ?></td>
                  <td><?= number_format($item['total'])  ?> VND</td>
                  <td><?= $item['phone'] ?></td>
                  <td><?= $item['date'] ?></td>
                  <td class="text-truncate" style="max-width: 200px;"><?= $data_adress ?></td>
                  <td>

                    <!-- <button class="btn btn-primary">Xác nhận giao thành công</button>
                 -->
                  </td>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="/admin/users/history/detail/<?= $item['id'] ?>"><i class='bx bxs-cart'></i></i>Chi tiết đơn hàng</a>
                        <form class="w-100" action="/admin/cancel/order/<?= $item['id'] ?>" method="post"
                          style="display: inline-block;">
                          <input type="hidden" name="method" value="POST">
                          <button class="dropdown-item delete-button button-del">
                            <i class="bx bx-trash me-1"></i> Hủy đơn hàng
                          </button>
                        </form>

                        <a
                          class="dropdown-item delete-shippingUpdates"
                          href="#"
                          data-url="/admin/order/shippingUpdates/<?= $item['id'] ?>">
                          <i class='bx bx-check-double'></i>Xác nhận giao hàng thành công
                        </a>

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

      <hr class="my-12" />

      <!-- Bootstrap Dark Table -->

      <!--/ Bootstrap Dark Table -->
    </div>





<?php
  }
}
