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
                <form action="" id="" method="post" enctype="multipart/form-data">
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
                      // Tạo mảng để nhóm value_variant và variant_id theo variant_name
                      $groupedVariants = [];

                      foreach ($data as $item) {
                        // Group by variant_name, storing both value_variant and variant_id
                        $groupedVariants[$item['variant_name']][] = [
                          'variant_id' => $item['variant_id'], // Save the variant_id
                          'value_variant' => $item['value_variant'] // Save the value_variant
                        ];
                      }

                      // Loại bỏ trùng lặp trong từng nhóm value_variant
                      foreach ($groupedVariants as $variantName => &$values) {
                        // Use array_map to get unique value_variant entries
                        $values = array_map(function ($value) {
                          return [
                            'variant_id' => $value['variant_id'], // Keep the variant_id
                            'value_variant' => $value['value_variant'] // Keep the value_variant
                          ];
                        }, array_unique($values, SORT_REGULAR));
                      }
                      unset($values); // Xóa tham chiếu để tránh lỗi không mong muốn
                  
                      // Lấy danh sách các tên variant (Dùng để hiển thị cột)
                      $variantNames = array_keys($groupedVariants);

                      // Hàm tạo tất cả các kết hợp của các giá trị variant
                      function generateCombinations($arrays)
                      {
                        $result = [[]];

                        foreach ($arrays as $array) {
                          $temp = [];
                          foreach ($result as $r) {
                            foreach ($array as $item) {
                              $temp[] = array_merge($r, [$item]);
                            }
                          }
                          $result = $temp;
                        }

                        return $result;
                      }

                      // Lấy tất cả các kết hợp
                      $combinations = generateCombinations(array_values($groupedVariants));

                      ?>
                    <tbody>
                      <?php foreach ($combinations as $combination): ?>
                        <?php
                        // Chuẩn bị dữ liệu để gán vào thuộc tính data
                        $rowData = [
                          'product_name' => $item['product_name'],
                          'variants' => array_map(fn($value) => $value['value_variant'], $combination),
                          'variant_ids' => array_map(fn($value) => $value['variant_id'], $combination)
                        ];
                        ?>
                        <tr class="variant-row">
                          <th class="product-name"><?= $rowData['product_name'] ?></th>
                          <?php foreach ($combination as $value): ?>
                            <td name="value_variant"><?= $value['value_variant'] ?></td>
                          <?php endforeach; ?>
                          <!-- Wrap the <a> tag inside a form to send the data on click -->
                          <td>
                            <form action="/admin/settingdetail/variant/<?= $item['product_id'] ?>" method="post">
                              <?php
                              $_SESSION['product_id'] = $item['product_id'];
                              ?>
                              <input type="hidden" name="method" value="POST">
                              <!-- Add hidden fields to store the row data -->
                              <input type="hidden" name="product_name" value="<?= $rowData['product_name'] ?>">
                              <input type="hidden" name="variants" value="<?= implode(',', $rowData['variants']) ?>">
                              <input type="hidden" name="variant_ids" value="<?= implode(',', $rowData['variant_ids']) ?>">
                              <!-- Add variant_ids to the form -->
                              <button type="submit" class="save-combination">
                                <i class='bx bxs-add-to-queue'></i>
                              </button>
                            </form>
                          </td>
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
