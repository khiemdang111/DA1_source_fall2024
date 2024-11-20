<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class SettingPriceVariant extends BaseView
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
                  <h2 class="text-center"></h2>
                </div>
              </div>
              <div class="card-body pt-4">
                <form action="/admin/productvariant" id="" method="post" enctype="multipart/form-data">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Tên</th>
                        <?php
                        $displayedVariants = []; // Mảng lưu trữ các variant_name đã hiển thị
                        foreach ($data as $itemVariant):
                          if (!in_array($itemVariant['variant_name'], $displayedVariants)): // Kiểm tra xem variant_name đã tồn tại chưa
                            $displayedVariants[] = $itemVariant['variant_name']; // Thêm vào mảng nếu chưa tồn tại
                            ?>
                            <th value="<?= $itemVariant['variant_name'] ?>">
                              <?= $itemVariant['variant_name'] ?>
                            </th>
                            <?php
                          endif;
                        endforeach;
                        ?>

                        <th scope="col">Cài đặt</th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php
                      // Tạo mảng để nhóm value_variant theo variant_id
                      $groupedVariants = [];

                      foreach ($data as $item) {
                        $groupedVariants[$item['variant_name']][] = $item['value_variant'];
                      }

                      // Loại bỏ trùng lặp trong từng nhóm value_variant
                      foreach ($groupedVariants as $variantName => &$values) {
                        $values = array_unique($values);
                      }
                      unset($values); // Xóa tham chiếu để tránh lỗi không mong muốn
                  
                      // Lấy danh sách các tên variant (Dùng để hiển thị cột)
                      $variantNames = array_keys($groupedVariants);

                      // Ghép cặp các value_variant
                      $combinations = [];
                      foreach ($groupedVariants[$variantNames[0]] as $value1) {
                        foreach ($groupedVariants[$variantNames[1]] as $value2) {
                          $combinations[] = [$value1, $value2];
                        }
                      }
                      ?>
                    <tbody>

                    <tbody>
                      <?php foreach ($combinations as $combination): ?>
                        <?php
                        // Chuẩn bị dữ liệu để gán vào thuộc tính data
                        $rowData = [
                          'product_name' => $_SESSION['product_name'] = $item['product_name'],
                          'variants' => array_map(fn($value) => $_SESSION['value_variant'] = $value, $combination)
                        ];
                        ?>
                        <tr class="variant-row"
                          data-row='<?= htmlspecialchars(json_encode($rowData), ENT_QUOTES, 'UTF-8') ?>'>
                          <th class="product-name"><?= $rowData['product_name'] ?></th>
                          <?php foreach ($combination as $value): ?>
                            <td name="value_variant"><?= $value ?></td>
                          <?php endforeach; ?>
                          <td><a href="#" class="save-combination"><i class='bx bxs-add-to-queue'></i></a></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </form>
              </div>
              <!-- /Account -->
            </div>
          </div>
        </div>
      </div>
      <script>
        CKEDITOR.replace('description');
        // Lắng nghe sự kiện click vào thẻ a
        document.querySelectorAll('.save-combination').forEach(function (link) {
          link.addEventListener('click', function (event) {
            event.preventDefault();  // Ngừng hành động mặc định của thẻ a (chuyển hướng)

            // Lấy dòng tr chứa thẻ a vừa được click
            var row = link.closest('tr');
            let id = row.getAttribute('data-id');
            // Lấy dữ liệu từ thuộc tính data-row
            var rowData = JSON.parse(row.getAttribute('data-row'));

            // In dữ liệu ra console để kiểm tra
            console.log(rowData);

            // Gửi dữ liệu qua AJAX nếu cần
            fetch('/admin/save-variant-data', {
              method: 'POST',
              body: JSON.stringify(id),
              headers: {
                'Content-Type': 'application/json'
              }
            })
              .then(response => response.json())
              .then(data => console.log('Dữ liệu đã gửi thành công:', data))
              .catch(error => console.error('Lỗi khi gửi dữ liệu:', error));
          });
        });
      </script>


      <?php
  }
}
