<?php

namespace App\Views\Admin\Pages\Vourcher;

use App\Views\BaseView;

class Edit extends BaseView
{
    public static function render($data = null)
    {
?>
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-6">
                            <!-- Account -->
                            <div class="card-body">
                                <div class="">
                                    <h2 class="text-center">Cập nhật vourcher</h2>
                                </div>
                            </div>
                            <div class="card-body pt-4">
                                <form action="/admin/vourcher/<?= $data['vourcher']['id'] ?>" id="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="method" id="" value="PUT">

                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Tên<span class="text-danger"> *</span></label>
                                        <input class="form-control" type="text" id="name" name="name" autofocus value="<?= $data['vourcher']['name'] ?>" />
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <label for="unit" class="form-label">Giá trị<span class="text-danger"> *</span></label>
                                        <input class="form-control" type="text" id="unit" name="unit" value="<?= $data['vourcher']['unit'] ?>" autofocus />
                                    </div>


                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <label for="date_start" class="form-label">Ngày bắt đầu<span class="text-danger"> *</span></label>
                                            <input class="form-control" type="date" id="date_start" name="date_start" autofocus value="<?= $data['vourcher']['date_start'] ?>" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="date_end" class="form-label">Ngày kết thúc<span class="text-danger"> *</span></label>
                                            <input class="form-control" type="date" id="date_end" name="date_end" autofocus value="<?= $data['vourcher']['date_end'] ?>" />
                                        </div>

                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <label class="form-label" for="user_id">Người sở hữu<span class="text-danger"> *</span></label>
                                        <select id="user_id" name="user_id" class="select2 form-select">
                                            <option value="">Chọn người sở hữu</option>

                                            <?php
                                            foreach ($data['user_all'] as $user_all) :
                                            ?>
                                                <option value="<?= $user_all['id']  ?>" <?= ($user_all['id'] == $data['vourcher']['user_id']) ? 'selected' : ''  ?>><?= $user_all['name']  ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <label for="status" class="form-label">Trạng thái<span class="text-danger"> *</span></label>
                                        <select id="status" name="status" class="select2 form-select">
                                            <option value="">Chọn trạng thái </option>
                                            <option value="1" <?php if ($data['vourcher']['status'] == 1) echo 'selected="selected"'; ?>>Hiển thị</option>
                                            <option value="2" <?php if ($data['vourcher']['status'] == 0) echo 'selected="selected"'; ?>>Ẩn</option>

                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-6">
                                        <button type="submit" class="btn btn-primary me-3" name>Lưu</button>
                                        <button type="reset" class="btn btn-outline-secondary" name>Nhập lại</button>
                                    </div>


                                </form>
                            </div>
                            <!-- /Account -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <script>
                CKEDITOR.replace('description');
            </script>
    <?php
    }
}
