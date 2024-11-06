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
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Sửa</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Xóa</a>
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
