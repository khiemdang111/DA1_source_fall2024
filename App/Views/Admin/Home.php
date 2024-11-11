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
      <!-- Navbar -->
      <nav
        class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
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
              <input
                type="text"
                class="form-control border-0 shadow-none ps-1 ps-sm-2"
                placeholder="Search..."
                aria-label="Search..." />
            </div>
          </div>
          <!-- /Search -->

          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->
            <li class="nav-item lh-1 me-4">
              <a
                class="github-button"
                href="https://github.com/themeselection/sneat-html-admin-template-free"
                data-icon="octicon-star"
                data-size="large"
                data-show-count="true"
                aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
            </li>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a
                class="nav-link dropdown-toggle hide-arrow p-0"
                href="javascript:void(0);"
                data-bs-toggle="dropdown">
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
                      <i class="flex-shrink-0 bx bx-credit-card bx-md me-3"></i><span class="flex-grow-1 align-middle">Billing Plan</span>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill text-secondary" viewBox="0 0 16 16">
                              <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-watch" viewBox="0 0 16 16">
                              <path d="M8.5 5a.5.5 0 0 0-1 0v2.5H6a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5-.5z" />
                              <path d="M5.667 16C4.747 16 4 15.254 4 14.333v-1.86A6 6 0 0 1 2 8c0-1.777.772-3.374 2-4.472V1.667C4 .747 4.746 0 5.667 0h4.666C11.253 0 12 .746 12 1.667v1.86a6 6 0 0 1 1.918 3.48.502.502 0 0 1 .582.493v1a.5.5 0 0 1-.582.493A6 6 0 0 1 12 12.473v1.86c0 .92-.746 1.667-1.667 1.667zM13 8A5 5 0 1 0 3 8a5 5 0 0 0 10 0" />
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                              <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                              <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                              <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-left-dots-fill" viewBox="0 0 16 16">
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
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
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <div class="card-title mb-0">
                        <h4 class="card-title mb-3">Số lượng sản phẩm theo loại</h4>
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="totalRevenue"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded bx-lg text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalRevenue">
                          <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                          <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                          <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                      </div>
                    </div>
                    <div>
                      <canvas id="product_by_category"></canvas>
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
                            <td> <img src="<?= APP_URL ?>public/uploads/products/<?= $item['image'] ?>" alt="Avatar" class="rounded-circle" width="60px" height="60px" /></td>
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
        <script>
          function producByCategory() {
            const ctx = document.getElementById('product_by_category');
            var php_data = <?= json_encode($data['product_by_category']) ?>;
            console.log(php_data);
            var labels = [];
            var data = [];
            for (let i of php_data) {
              // console.log(i);
              labels.push(i.name);
              data.push(i.count);

            }
            console.log(labels);
            console.log(data);
            new Chart(ctx, {
              type: 'bar',
              data: {
                labels,
                datasets: [{
                  label: 'Số lượng sản phẩm ',
                  data: data,
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          }


          producByCategory();
        </script>
    <?php
  }
}

    ?>