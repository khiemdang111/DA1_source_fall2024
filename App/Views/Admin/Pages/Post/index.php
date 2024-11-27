<?php

namespace App\Views\Admin\Pages\Post;

use App\Views\BaseView;

class index extends BaseView
{
    public static function render($data = null)
    {
        ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-3">
                <h5 class="card-header">Danh sách bài viết</h5>
                <div class="card-body">
                    <!-- Basic Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Danh sách bài viết</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header">
                    <form action="/admin/posts/search" method="get">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control" name="keywords"
                                value="<?= (isset($_SESSION['keywords']) ? $_SESSION['keywords'] : "") ?>"
                                placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="basic-addon-search31" />
                        </div>

                    </form>
                </div>
                <div class="table-responsive text-nowrap">
                    <?php
                    if (count($data)):
                        ?>
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Tiêu đề</th>
                                    <th>Avatar</th>
                                    <th>Mô tả ngắn</th>
                                    <th>Trạng thái</th>
                                    <th>Tùy chỉnh</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                foreach ($data['posts'] as $item):
                                    ?>
                                    <tr>
                                        <td> <?= $item['id'] ?></td>
                                        <td class="text-truncate" style="max-width: 200px;">
                                            <?= $item['title'] ?>
                                        </td>
                                        <td>
                                            <img src="<?= APP_URL ?>/public/uploads/posts/<?= $item['img'] ?>" alt="Avatar"
                                                class="rounded-circle" width="60px" height="60px" />
                                        </td>
                                        <td class="text-truncate" style="max-width: 200px;">
                                            <?= $item['summary'] ?>
                                        </td>
                                        <td class="text-truncate"><?= ($item['status'] == 0) ? 'Khóa ' : 'Hoạt động ' ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="/admin/posts/<?= $item['id'] ?>"><i
                                                            class="bx bx-edit-alt me-1"></i> Sửa</a>
                                                    <form class="w-100" action="/admin/delete/<?= $item['id'] ?>" method="post"
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
                        <?php
                    else:
                        ?>
                        <h4 class="text-center text-danger">Không có dữ liệu</h4>
                        <?php
                    endif;

                    ?>
                </div>
            </div>
            <div class="row my-3 justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination d-flex justify-content-center">
                        <?php
                        $currentPage = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
                        $totalPages = $data['total_pages'];

                        $prevPage = $currentPage - 1;
                        ?>
                        <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= $currentPage > 1 ? '/admin/posts?pages=' . $prevPage : '#' ?>">
                                << </a>
                        </li>

                        <?php
                        for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                                <a class="page-link" href="/admin/posts?pages=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php
                        $nextPage = $currentPage + 1;
                        ?>
                        <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link"
                                href="<?= $currentPage < $totalPages ? '/admin/posts?pages=' . $nextPage : '#' ?>"> >> </a>
                        </li>
                    </ul>
                </nav>

            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <?php
    }
}
