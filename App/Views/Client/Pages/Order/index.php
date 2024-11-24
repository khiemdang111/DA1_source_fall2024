<?php

namespace App\Views\Client\Pages\Order;


use App\Views\BaseView;
use App\Views\Client\Components\NavbarAccount;

class index extends BaseView
{
  public static function render($data = null)
  {
    // echo '<pre>';
    // var_dump($data[0]['id']);
    // die;
    ?>

    <div class="container">
      <div class="row p-5">
        <div class="col-md-3">
          <div class="sidebar-box ftco-animate">
            <div class="categories">
              <h3>Lịch sử mua hàng </h3>
              <?php
              NavbarAccount::render($data);
              ?>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card border-dark mb-3">
            <div class="card-header">Lịch sử thanh toán</div>

            <?php
            if (count($data)):
              foreach ($data as $item):
                // var_dump($item);
                // die;
                ?>
                <div class="item">
                  <div class="d-flex justify-content-between m-1 item_dflex">
                    <div class="item">Ngày thanh toán : <span class=""><?= $item['date'] ?></span></div>
                  </div>
                  <div class="row m-2 item_dflex ">
                    <table border="1" class="w-100 m-1 account_order">
                      <thead>
                        <tr>
                          <th>Mã đơn hàng</th>
                          <th>Số tiền thanh toán</th>
                          <th>Phương thức thanh toán</th>
                          <th>Trạng thái</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?= $item['id'] ?></td>
                          <td><?= number_format($item['total']) ?></td>

                          <td>
                            <?php
                            if ($item['paymentMethod'] === "COD"):
                              ?>
                              Thanh toán khi nhận hàng
                              <?php
                            else:
                              ?>
                             VNPAY
                              <?php
                            endif;
                            ?>
                          </td>
                          <td>
                            <?php
                            if ($item['orderStatus'] === "0"):
                              ?>
                              Chưa thanh toán
                              <?php
                            else:
                              ?>
                              Đã thanh toán
                              <?php
                            endif;
                            ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                  </div>

                  <div class="d-flex m-2 justify-content-end">
                    <a href="/order/detail/<?=$item['id']?>" class="btn btn-primary m-1">Xem chi tiết</a>
                    <!-- <a href="" class="btn btn-primary m-1">Mua lại</a> -->
                  </div>
                </div>

                <?php
              endforeach;
            endif; ?>

          </div>
          <!-- <div class="card">
            <h5 class="card-body text-primary">Thông tin đơn hàng</h5>
            <div class="d-flex justify-content-between">
              <div class="item">nfjeidfhi</div>
              <div class="item">fenfnuhi</div>
            </div>
          </div> -->

        </div>
      </div>
    </div>
    <?php
  }
}