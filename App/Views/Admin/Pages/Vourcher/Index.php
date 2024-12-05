<?php

namespace App\Views\Admin\Pages\Vourcher;

use App\Views\BaseView;

class Index extends BaseView
{
    public static function render($data = null)
    {
        ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card mb-3">
                    <h5 class="card-header">Danh sách vourcher</h5>
                    <div class="card-body">
                        <!-- Basic Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0);">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0);">Danh sách vourcher</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <form action="/admin/categories/search" method="get">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                <input type="text" class="form-control" name="keywords"
                                    value="<?= (isset($_SESSION['keywords']) ? $_SESSION['keywords'] : "") ?>"
                                    placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="basic-addon-search31" />
                            </div>

                        </form>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th >Id</th>
                                    <th>Tên</th>
                                    <th >Giá trị </th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Người sở hữu</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                foreach ($data as $item):
                                    ?>
                                    <tr>
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['unit'] ?></td>
                                        <td><?= $item['date_start'] ?></td>
                                        <td><?= $item['date_end']?></td>
                                        <td><?= $item['username']?></td>

                                        <td><?= ($item['status'] == 1) ? 'Hiển thị' : 'Ẩn' ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="/admin/categories/<?= $item['id'] ?>"><i
                                                            class="bx bx-edit-alt me-1"></i> Sửa</a>
                                                    <form class="w-100" action="/admin/delete/categories/<?= $item['id'] ?>"
                                                        method="post" style="display: inline-block;"
                                                        onsubmit="return confirm('Chắc chưa?')">
                                                        <input type="hidden" name="method" value="POST" id="">
                                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                        <button class="dropdown-item"><i class="bx bx-trash me-1"></i> Xóa</button>
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
