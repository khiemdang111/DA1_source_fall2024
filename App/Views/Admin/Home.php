<?php

namespace App\Views\Admin;

use App\Views\BaseView;

class Home extends BaseView
{
  public static function render($data = null)
  {
    ?>
    <!-- Layout container -->
    <div class="layout-page-1">

      <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
          <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="bx bx-menu bx-md"></i>
          </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
          <!-- Search -->
          <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
              <i class="bx bx-search bx-md"></i>
              <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2" placeholder="Search..."
                aria-label="Search..." />
            </div>
          </div>
          <!-- /Search -->

          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->
            <li class="nav-item lh-1 me-4">
              <a class="github-button" href="https://github.com/themeselection/sneat-html-admin-template-free"
                data-icon="octicon-star" data-size="large" data-show-count="true"
                aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
            </li>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                  <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-0">John Doe</h6>
                        <small class="text-muted">Admin</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider my-1"></div>
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                    <i class="bx bx-user bx-md me-3"></i><span>My Profile</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#"> <i class="bx bx-cog bx-md me-3"></i><span>Settings</span> </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                    <span class="d-flex align-items-center align-middle">
                      <i class="flex-shrink-0 bx bx-credit-card bx-md me-3"></i><span
                        class="flex-grow-1 align-middle">Billing Plan</span>
                      <span class="flex-shrink-0 badge rounded-pill bg-danger">4</span>
                    </span>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider my-1"></div>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0);">
                    <i class="bx bx-power-off bx-md me-3"></i><span>Log Out</span>
                  </a>
                </li>
              </ul>
            </li>
            <!--/ User -->
          </ul>
        </div>
      </nav>

      <!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="row">
            <div class="col-xxl-12 mb-6 order-0">
              <div class="row p-2  thongke">
                <h4 class="card-title text-primary mb-3">Thống kê 🎉</h4>
                <div class="row">
                  <div class="col-lg-3 col-md-12 col-6 mb-6">
                    <div class="card h-80">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                          <div class="text-primary title_card">
                            <a href="/admin/users" class="text-primary">Khách hàng</a>
                          </div>
                          <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                              style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                              <path
                                d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z">
                              </path>
                            </svg>
                          </div>
                        </div>
                        <p class="mb-1">Số lượng</p>
                        <h4 class="card-title mb-3"><?= $data['total_user'] ?></h4>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-12 col-6 mb-6">
                    <div class="card h-80">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                          <div class="text-primary title_card">
                            <a href="/admin/products" class="text-primary">Sản phẩm</a>
                          </div>
                          <div class="icon_card">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                              style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                              <path
                                d="M11 17.916V20H9v2h6v-2h-2v-2.084c3.162-.402 5.849-2.66 6.713-5.793.264-.952.312-2.03.143-3.206l-.866-6.059A1 1 0 0 0 18 2H6a1 1 0 0 0-.99.858l-.865 6.058c-.169 1.177-.121 2.255.143 3.206.863 3.134 3.55 5.392 6.712 5.794zM17.133 4l.57 4H6.296l.571-4h10.266z">
                              </path>
                            </svg>
                          </div>
                        </div>
                        <p class="mb-1">Số lượng</p>
                        <h4 class="card-title mb-3"><?= $data['total_product'] ?></h4>

                      </div>


                    </div>
                  </div>
                  <div class="col-3 mb-6">
                    <div class="card h-80">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                          <div class="text-primary title_card">
                            <a href="/admin/categories" class="text-primary">Loại sản phẩm</a>
                          </div>
                          <div class="icon_card">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                              style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                              <path
                                d="M4 11h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1zm10 0h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1zM4 21h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1zm13 0c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4z">
                              </path>
                            </svg>
                          </div>
                        </div>
                        <p class="mb-1">Số lượng</p>
                        <h4 class="card-title mb-3"><?= $data['total_category'] ?></h4>
                      </div>
                    </div>
                  </div>
                  <div class="col-3 mb-6">
                    <div class="card h-80">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                          <div class="text-primary title_card">
                            <a href="/admin/products" class="text-primary">Bình luận</a>
                          </div>
                          <div class="icon_card">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                              style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                              <path d="M20 2H4c-1.103 0-2 .897-2 2v18l4-4h14c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2z">
                              </path>
                            </svg>

                          </div>
                        </div>
                        <p class="mb-1">Số lượng</p>
                        <h4 class="card-title mb-3"><?= $data['total_comment'] ?></h4>

                      </div>


                    </div>
                  </div>
                </div>
              </div>

            </div>

            <!-- Total Revenue -->
            <div class="col-12 col-xxl-12 order-2 order-md-3 order-xxl-2 mb-6">
              <div class="card">
                <div class="row row-bordered g-0">
                  <div class="col-lg-6">
                    <div class="card-header d-flex  justify-content-between">


                      <h5 class="card-title mb-0">Thống kê doanh thu theo ngày</h5>

                      <select class="form-select w-50" aria-label="Default select example">

                        <option value="3">3 Ngày</option>
                        <option value="5">5 Ngày</option>
                        <option value="7">7 Ngày</option>
                      </select>

                    </div>
                    <div>

                      <div id="myfirstchart" style="height: 400px;"></div>

                    </div>
                  </div>
                  <div class="col-lg-6 p-2">
                    <h4 class="card-title m-3">Top 5 sản phẩm có lượt xem nhiều nhất</h4>

                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Tên sản phẩm</th>
                          <th scope="col">Hình ảnh</th>
                          <th scope="col">Giá</th>
                          <th scope="col">Số lượt xem</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php foreach ($data['product_view'] as $item):
                          ?>
                          <tr>
                            <th scope="row"><?= $item['id'] ?></th>
                            <th scope="row"><?= $item['name'] ?></th>
                            <td> <img src="<?= APP_URL ?>public/uploads/products/<?= $item['image'] ?>" alt="Avatar"
                                class="rounded-circle" width="60px" height="60px" /></td>
                            <td>Otto</td>
                            <td>
                              <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary rounded-3 fw-semibold ahihi"><?= $item['view'] ?></span>
                              </div>

                          </tr>
                          <?php
                        endforeach;
                        ?>



                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Total Revenue -->

          </div>

        </div>
        <!-- / Content -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        <script>
          $(document).ready(function () {
            statistical();
            var char = new Morris.Bar({
              element: 'myfirstchart',
              xkey: 'order_day',
              ykeys: ['total_value', 'total_orders'],
              labels: ['Doanh thu', 'Số lượng bán ra']
            });
            function statistical() {
              $(document).ready(function () {
                var date = $(this).val(); 
                date = 365;
                console.log('Default date: ' + date);
                $.ajax({
                  url: '/statistical',
                  method: 'POST',
                  dataType: 'JSON',
                  data: {
                    date: date, 
                    method: 'POST',
                  },
                  success: function (data) {
                    console.log(data);
                    char.setData(data); 
                    $('#text-date').text('Default date: 365');
                  }
                });
              });
              $('.form-select').change(function () {
                var date = $(this).val(); 
                console.log(date);

                $.ajax({
                  url: '/statistical',
                  method: 'POST',
                  dataType: 'JSON',
                  data: {
                    date: date,
                    method: 'POST',
                  },
                  success: function (data) {
                    console.log(data);

                    char.setData(data); 
                    $('#text-date').text(date); 
                  }
                });
              });
            }

          });
        </script>


        <?php
  }
}

?>