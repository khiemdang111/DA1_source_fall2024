<?php

namespace App\Views\Client\Pages\Order;


use App\Views\BaseView;
use App\Views\Client\Components\NavbarAccount;

class index extends BaseView
{
  public static function render($data = null)
  {
    ?>
    <div class="container">
      <div class="row p-5">
        <div class="col-md-4">
          <div class="sidebar-box ftco-animate">
            <div class="categories">
              <h3>Lịch sử mua hàng </h3>
              <?php
              NavbarAccount::render($data);
              ?>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card border-dark mb-3">
            <div class="card-header">Thông tin đơn hàng</div>
            <div class="d-flex justify-content-between  m-2 item_dflex">
              <div class="item"><a href="">Liên hệ Shop</a></div>
              <div class="item"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                  <path
                    d="M19.15 8a2 2 0 0 0-1.72-1H15V5a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v10a2 2 0 0 0 1 1.73 3.49 3.49 0 0 0 7 .27h3.1a3.48 3.48 0 0 0 6.9 0 2 2 0 0 0 2-2v-3a1.07 1.07 0 0 0-.14-.52zM15 9h2.43l1.8 3H15zM6.5 19A1.5 1.5 0 1 1 8 17.5 1.5 1.5 0 0 1 6.5 19zm10 0a1.5 1.5 0 1 1 1.5-1.5 1.5 1.5 0 0 1-1.5 1.5z">
                  </path>
                </svg> : Đang vận chuyển</div>
            </div>

            <div class="row m-2 item_dflex">
              <div class="col-xl-2"><img src="public/uploads/image/20240804120825.png" alt="" width="100%"></div>
              <div class="col-xl-8">
                <h5 class="">Tên</h5>
                <h6 class="">SL</h6>
              </div>
              <div class="col-xl-2 d-flex flex-column justify-content-center">
                <h6 class="">GIÁ </h6>
              </div>
            </div>
            <div class="d-flex m-2 justify-content-end">
              <svg class="m-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                <path
                  d="M21 4H3a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-1 11a3 3 0 0 0-3 3H7a3 3 0 0 0-3-3V9a3 3 0 0 0 3-3h10a3 3 0 0 0 3 3v6z">
                </path>
                <path
                  d="M12 8c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z">
                </path> 
              </svg> Tổng số tiền :
            </div>
            <div class="d-flex m-2 justify-content-end">
              <a href="" class="btn btn-primary m-1">Mua lại</a>
              <a href="" class="btn btn-primary m-1">Chi tiết đơn hàng</a>
              <!-- <a href="" class="btn btn-primary m-1">Mua lại</a> -->
            </div>


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