<?php

namespace App\Views\Client\Pages\Order;


use App\Views\BaseView;
use App\Views\Client\Components\NavbarAccount;

class detail extends BaseView
{
  public static function render($data = null)
  {
    $data_adress = $data[0]['address'] . " " . $data[0]['ward'] . " " . $data[0]['district'] . " " . $data[0]['province'];
//         echo '<pre>';
// var_dump($data[0]['total']);
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
          <div class="card border-dark ">
            <div class="card-header">Chi tiết thanh toán - <span class="text-danger">

                <?php
                if ($data[0]['orderStatus'] === 1):
                  ?>
                  Đã thanh toán
                  <?php
                else:
                  ?>
                  Chưa thanh toán
                  <?php
                endif;
                ?>
              </span></div>
            <div class="item">
              <div class="d-flex justify-content-between m-1 item_dflex">
                <div class="item "><svg class="mb-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                    viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                    <path
                      d="m12 17 1-2V9.858c1.721-.447 3-2 3-3.858 0-2.206-1.794-4-4-4S8 3.794 8 6c0 1.858 1.279 3.411 3 3.858V15l1 2zM10 6c0-1.103.897-2 2-2s2 .897 2 2-.897 2-2 2-2-.897-2-2z">
                    </path>
                    <path
                      d="m16.267 10.563-.533 1.928C18.325 13.207 20 14.584 20 16c0 1.892-3.285 4-8 4s-8-2.108-8-4c0-1.416 1.675-2.793 4.267-3.51l-.533-1.928C4.197 11.54 2 13.623 2 16c0 3.364 4.393 6 10 6s10-2.636 10-6c0-2.377-2.197-4.46-5.733-5.437z">
                    </path>
                  </svg> Địa chỉ nhận hàng : <?= $data_adress ?> . </span></div>
              </div>
              <div class="item_dflex_bottom">
                <div class="row m-2">
                  <table border="1" class="w-100 m-1 account_order">
                    <thead>
                      <tr>
                        <th>Người nhận </th>
                        <th>Số điện thoại</th>
                        <th>Phương thức thanh toán</th>
                        <th>Thời gian đặt hàng</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Trịnh Hải đảo</td>
                        <td>0839644625</td>
                        <td>
                          <?php
                          if ($data[0]['paymentMethod'] === "COD"):
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
                        <td><?= $data[0]['date'] ?></td>
                      </tr>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>

            <div class="item">
              <div class="d-flex justify-content-between  m-2 item_dflex">
                <div class="item"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                    <path
                      d="M20 6h-3V4c0-1.103-.897-2-2-2H9c-1.103 0-2 .897-2 2v2H4c-1.103 0-2 .897-2 2v3h20V8c0-1.103-.897-2-2-2zM9 4h6v2H9V4zm5 10h-4v-2H2v7c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2v-7h-8v2z">
                    </path>
                  </svg> Thông tin sản phẩm</div>
              </div>


              <?php
              if (count($data)):
                foreach ($data as $item):
                  ?>
                  <div class="row m-2 item_dflex">
                    <div class="col-xl-2"><img src="/public/uploads/products/<?= $item['product_image'] ?>" alt="" width="100%"></div>
                    <div class="col-xl-5">
                      <h6 class="m-0"><?= $item['product_name'] ?></h6>
                      <h6 class="mt-3 mb-0">Số lượng : <?= $item['quantity'] ?></h6>
                    </div>
                    <div class="col-xl-5 d-flex flex-column justify-content-end">
                      <div class="d-flex justify-content-between">

                        <?php
                        if ($item['originalPrice'] > 0):
                          ?>
                          <div class="item">Giá : </div>
                          <div class="item"> <del><?= number_format( $item['originalPrice']) ?> VND</del> <?= number_format($item['unitPrice'])  ?> VND </div>
                        <?php
                        else:
                          ?>
                          <div class="item">Giá : </div>
                          <div class="item"><?= number_format( $item['unitPrice']) ?> VND</div>
                        <?php
                        endif;
                        ?>

                      </div>
                      <div class="d-flex justify-content-between">
                        <div class="item">Tổng tiền : </div>
                        <div class="item"> <?= number_format($item['totalPrice'])  ?> VND</div>
                      </div>

                    </div>
                  </div>
                  <?php
                endforeach;
              endif;
              ?>




              <div class="d-flex m-2 justify-content-end">
                <svg class="m-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                  <path
                    d="M21 4H3a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-1 11a3 3 0 0 0-3 3H7a3 3 0 0 0-3-3V9a3 3 0 0 0 3-3h10a3 3 0 0 0 3 3v6z">
                  </path>
                  <path
                    d="M12 8c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z">
                  </path>
                </svg> Tổng số tiền : <?= number_format($data[0]['total'])?> VND
              </div>
              <div class="d-flex m-2 justify-content-end">
                <a href="/" class="btn btn-primary m-1">Mua lại</a>
                <!-- <a href="" class="btn btn-primary m-1">Mua lại</a> -->
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

    <div class="d-flex m-2 justify-content-end">
      <a href="/order/detail" class="btn btn-primary m-1">Xem chi tiết</a>
      <!-- <a href="" class="btn btn-primary m-1">Mua lại</a> -->
    </div>
    <?php
  }
}