<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class index extends BaseView
{
  public static function render($data = null)
  {
    ?>
    <div class="layout-page">
      <!-- Navbar -->

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
                      <td><img src="<?= APP_URL ?>/public/uploads/products/<?= $item['image'] ?>" alt="" width="100px"></td>
                      <td><?= $item['name'] ?></td>
                      <td><?= number_format($item['price']) ?></td>
                      <td><?= ($item['status'] == 1) ? 'Hiển thị' : 'Ẩn' ?></td>
                      <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="bx bx-edit-alt me-1"></i> Sửa</a
                              >
                              <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="bx bx-trash me-1"></i> Xóa</a
                              >
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
          <div class="card overflow-hidden">
            <h5 class="card-header">Table Dark</h5>
            <div class="table-responsive text-nowrap">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th>Project</th>
                    <th>Client</th>
                    <th>Users</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  <tr>
                    <td><i class="bx bxl-angular bx-md text-danger me-4"></i> <span>Angular Project</span></td>
                    <td>Albert Cook</td>
                    <td>
                      <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                          class="avatar avatar-xs pull-up" title="Lilian Fuller">
                          <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                          class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                          <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                          class="avatar avatar-xs pull-up" title="Christina Parker">
                          <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                        </li>
                      </ul>
                    </td>
                    <td><span class="badge bg-label-primary me-1">Active</span></td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td><i class="bx bxl-react bx-md text-info me-4"></i> <span>React Project</span></td>
                    <td>Barry Hunter</td>
                    <td>
                      <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                          class="avatar avatar-xs pull-up" title="Lilian Fuller">
                          <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                          class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                          <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                          class="avatar avatar-xs pull-up" title="Christina Parker">
                          <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                        </li>
                      </ul>
                    </td>
                    <td><span class="badge bg-label-success me-1">Completed</span></td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td><i class="bx bxl-vuejs bx-md text-success me-4"></i> <span>VueJs Project</span></td>
                    <td>Trevor Baker</td>
                    <td>
                      <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                          class="avatar avatar-xs pull-up" title="Lilian Fuller">
                          <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                          class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                          <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                          class="avatar avatar-xs pull-up" title="Christina Parker">
                          <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                        </li>
                      </ul>
                    </td>
                    <td><span class="badge bg-label-info me-1">Scheduled</span></td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="rounded-start-bottom">
                      <i class="bx bxl-bootstrap bx-md text-primary me-3"></i> <span>Bootstrap Project</span>
                    </td>
                    <td>Jerry Milton</td>
                    <td>
                      <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                          class="avatar avatar-xs pull-up" title="Lilian Fuller">
                          <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                          class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                          <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                          class="avatar avatar-xs pull-up" title="Christina Parker">
                          <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                        </li>
                      </ul>
                    </td>
                    <td><span class="badge bg-label-warning me-1">Pending</span></td>
                    <td class="rounded-end-bottom">
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!--/ Bootstrap Dark Table -->
        </div>


        <?php
  }
}
