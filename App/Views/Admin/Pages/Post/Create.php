<?php

namespace App\Views\Admin\Pages\Post;


use App\Views\BaseView;

class Create extends BaseView
{
  public static function render($data = null)
  {
?>

    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-6">
              <!-- Account -->
              <div class="card-body">
                <div class="">
                  <h2 class="text-center">Thêm mới bài viết </h2>
                </div>
              </div>
              <div class="card-body pt-4">
                <form action="/admin/posts" id="" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="method" id="" value="POST">
                  <div class="row g-6">
                    <div class="col-md-12">
                      <label for="title" class="form-label">Tiêu đề <span class="text-danger"> *</span></label>
                      <input class="form-control" type="text" id="title" name="title" autofocus />
                    </div>

                    <div class="col-md-12">
                      <label for="img" class="form-label">Ảnh đại diện<span class="text-danger"> *</span></label>
                      <input class="form-control" type="file" id="img" name="img" />
                    </div>
                    <div class="col-md-12">
                      <label for="summary" class="form-label">Mô tả ngắn </label>
                      <textarea name="summary" id="summary"></textarea>
                    </div>

                    <div class="col-md-12">
                      <label for="content" class="form-label">Nội dung </label>
                      <textarea name="content" id="content"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="user_id">Tác giả<span class="text-danger"> *</span></label>
                        <select id="user_id" name="user_id" class="select2 form-select">
                          <option value="">Chọn tác giả</option>
                      
                          <?php 
                          foreach($data['user_all'] as $user_all ) :
                          ?>
                          <option value="<?=  $user_all['id']  ?>"><?=  $user_all['name']  ?></option>
                          <?php 
                          endforeach;
                          ?>
                        </select>
                      </div>

                      <div class="col-md-6">
                        <label class="form-label" for="category_post_id">Danh mục bài viết<span class="text-danger"> *</span></label>
                        <select id="category_post_id" name="category_post_id" class="select2 form-select">
                          <option value="">Chọn danh mục</option>
                      
                          <?php 
                          foreach($data['category_post_all'] as $category_post_all ) :
                          ?>
                          <option value="<?=  $category_post_all['id']  ?>"><?=  $category_post_all['name']  ?></option>
                          <?php 
                          endforeach;
                          ?>
                        </select>
                      </div>
                    <div class="col-md-12">
                      <label for="status" class="form-label">Trạng thái<span class="text-danger"> *</span></label>
                      <select id="status" class="select2 form-select" name="status">
                        <option value="">Chọn trạng thái</option>
                        <option value="1">Kích hoạt</option>
                        <option value="0">Không kích hoạt</option>
                      </select>
                    </div>

                  </div>
                  <div class="mt-6">
                    <button type="submit" class="btn btn-primary me-3" name>Thêm</button>
                    <button type="reset" class="btn btn-outline-secondary" name>Nhập lại</button>
                  </div>
                </form>
              </div>
              <!-- /Account -->
            </div>
          </div>
        </div>
      </div>
      <script>
        CKEDITOR.replace('summary');
        CKEDITOR.replace('content');

    </script>
      

  <?php
  }
}
