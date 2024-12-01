<?php

namespace App\Models;

class ProductVariant extends BaseModel
{
  protected $table = 'product_variant';
  protected $id = 'id';

  public function getAllProductByStatus()
  {
    $result = [];
    try {
      $sql = "SELECT products.*, categories.name AS category_name FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.status=" . self::STATUS_ENABLE . " AND categories.status=" . self::STATUS_ENABLE;
      $result = $this->_conn->MySQLi()->query($sql);
      return $result->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  // public function getOneProductByStatus($id)
  // {

  // }
  public function getAllProductJoinCategory()
  {
    $result = [];
    try {
      $sql = "SELECT products.*,categories.name AS category_name FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.status !=" . self::STATUS_DISABLE . " ";
      $result = $this->_conn->MySQLi()->query($sql);
      return $result->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function getOneProductByName($name)
  {
    return $this->getOneByName($name);
  }
  public function getAllProductJoinCategoryDetail($id)
  {
    $result = [];
    try {
      $sql = "SELECT products.*,categories.name AS category_name FROM products INNER JOIN categories ON products.category_id = categories.id 
            WHERE products.status =" . self::STATUS_ENABLE . "  
            AND  categories.status = " . self::STATUS_ENABLE . "  AND products.category_id =$id";
      $result = $this->_conn->MySQLi()->query($sql);
      return $result->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function getOneProductByCategoryDetailStatus($id)
  {
    $result = [];
    try {
      $sql = "SELECT products.*,categories.name AS category_name FROM products INNER JOIN categories ON products.category_id = categories.id 
            WHERE products.status =" . self::STATUS_ENABLE . "  
            AND products.id =?";
      $conn = $this->_conn->MySQLi();
      $stmt = $conn->prepare($sql);

      $stmt->bind_param('i', $id);
      $stmt->execute();
      return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function getOneProductByStatus(int $id)
  {
    $result = [];
    try {
      $sql = "SELECT products.*, categories.name AS category_name FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.status=" . self::STATUS_ENABLE . " AND categories.status=" . self::STATUS_ENABLE . " AND products.id=?";
      $conn = $this->_conn->MySQLi();
      $stmt = $conn->prepare($sql);

      $stmt->bind_param('i', $id);
      $stmt->execute();
      return $stmt->get_result()->fetch_assoc();
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function getAllProductByVariant()
  {
    $result = [];
    try {
      $sql = "SELECT products.*, product_variants.id AS product_variant_id, product_variants.name AS product_variant_name  FROM `products` INNER JOIN product_variants on products.id = product_variants.product_id WHERE product_variants.status = " . self::STATUS_ENABLE . "";
      $result = $this->_conn->MySQLi()->query($sql);
      return $result->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function getAllVariantOptionsById($id)
  {
    $result = [];
    try {
      $sql = "SELECT product_variant_options.*, products.id AS pro_id, product_variants.name AS pro_variant_name , product_variants.id AS pro_variant_id FROM product_variant_options INNER JOIN product_variants on product_variant_options.product_variant_id = product_variants.id INNER JOIN products on product_variants.product_id = products.id WHERE product_variants.status = " . self::STATUS_ENABLE . "";
      $result = $this->_conn->MySQLi()->query($sql);
      return $result->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function createProductVariant(array $data_product_variants)
  {
    try {
      // Bắt đầu câu lệnh SQL
      $sql = "INSERT INTO product_variant_values (product_id, product_variant_id, option_id) VALUES ";
      $values = [];

      // Duyệt qua các phần tử của mảng và xây dựng câu SQL
      foreach ($data_product_variants as $variant) {
        $product_id = (int) $variant['product_id'];
        $product_variant_id = (int) $variant['pro_variant_id'];
        $option_id = (int) $variant['option_id'];
        $values[] = "($product_id, $product_variant_id, $option_id)";
      }

      // Nối danh sách values vào câu SQL
      if (empty($values)) {
        throw new \Exception("Không có dữ liệu để thêm.");
      }

      $sql .= implode(", ", $values);
      // Thực thi câu lệnh SQL
      $conn = $this->_conn->MySQLi();
      if (!$conn->query($sql)) {
        throw new \Exception("MySQL Error: " . $conn->error);
      }
      header('Location: /admin/productvariant/setting');
      return true;
    } catch (\Throwable $th) {
      error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
      return false;
    }
  }
  public function getAllVariantAndAttribute()
  {
    $result = [];
    try {
      $sql = "SELECT product_variants.*, product_variant_options.name AS option_name, product_variant_options.status AS option_status FROM `product_variants` INNER JOIN product_variant_options on product_variants.id = product_variant_options.product_variant_id WHERE product_variants.status =1 AND product_variant_options.status = 1";
      $result = $this->_conn->MySQLi()->query($sql);
      return $result->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function createNameVariant($data)
  {
    try {
      // Kiểm tra dữ liệu đầu vào
      if (!isset($data['name']) || empty($data['name'])) {
        throw new \Exception('Name không hợp lệ');
      }
      if (!isset($data['product_id']) || empty($data['product_id'])) {
        throw new \Exception('Product ID không hợp lệ');
      }

      // Kết nối cơ sở dữ liệu
      $conn = $this->_conn->MySQLi();
      if (!$conn) {
        throw new \Exception('Không thể kết nối cơ sở dữ liệu');
      }

      // Sử dụng prepared statement để bảo mật
      $stmt = $conn->prepare("INSERT INTO product_variants (name, product_id) VALUES (?, ?)");
      if (!$stmt) {
        throw new \Exception('Lỗi chuẩn bị câu lệnh SQL: ' . $conn->error);
      }

      // Gán tham số vào câu lệnh và thực thi
      $name = $data['name'];
      $product_id = (int) $data['product_id']; // Đảm bảo product_id là số nguyên
      $stmt->bind_param("si", $name, $product_id);
      if (!$stmt->execute()) {
        throw new \Exception('Lỗi thực thi câu lệnh SQL: ' . $stmt->error);
      }

      // Lấy ID bản ghi vừa thêm
      $insert_id = $stmt->insert_id;

      // Đóng tài nguyên
      $stmt->close();
      $conn->close();

      // Trả về ID bản ghi vừa thêm
      return $insert_id;
    } catch (\Throwable $th) {
      error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
      return false;
    }
  }

  public function createValueVariant($data)
  {
    try {
      // Kiểm tra dữ liệu đầu vào
      if (!isset($data['value']) || empty($data['value'])) {
        throw new \Exception('Value không hợp lệ');
      }

      $conn = $this->_conn->MySQLi();
      if (!$conn) {
        throw new \Exception('Không thể kết nối cơ sở dữ liệu');
      }

      // Lấy product_variant_id nếu không được cung cấp
      if (!isset($data['product_variant_id']) || empty($data['product_variant_id'])) {
        $result = $conn->query("SELECT id FROM `product_variants` ORDER BY id DESC LIMIT 1");

        if ($result && $row = $result->fetch_assoc()) {
          $data['product_variant_id'] = $row['id'];
        } else {
          throw new \Exception('Không tìm thấy product_variant_id');
        }
      }
      // Sử dụng prepared statement để bảo mật
      $stmt = $conn->prepare("INSERT INTO product_variant_options (name, product_variant_id, product_id) VALUES (?, ?, ?)");
      if (!$stmt) {
        throw new \Exception('Lỗi chuẩn bị câu lệnh SQL: ' . $conn->error);
      }

      // Gán tham số vào câu lệnh và thực thi
      $value = $data['value'];
      $product_variant_id = $data['product_variant_id'];
      $product_id = $data['product_id']; // Đảm bảo product_id là số nguyên
      $stmt->bind_param("sii", $value, $product_variant_id, $product_id);

      if (!$stmt->execute()) {
        throw new \Exception('Lỗi thực thi câu lệnh SQL: ' . $stmt->error);
      }

      // Chuyển hướng sau khi thành công
      header("Location: /admin/variant/add");
      return true;
    } catch (\Throwable $th) {
      error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
      return false;
    }
  }
  public function getAllVariantByProductId($id)
  {
    $result = [];
    try {
      $sql = "SELECT product_variant_values.id AS id, product_variants.name AS variant_name, product_variant_options.name AS option_name FROM `product_variant_values` INNER JOIN `product_variant_options` ON product_variant_values.option_id = product_variant_options.id INNER JOIN `product_variants` ON product_variants.id = product_variant_options.product_variant_id WHERE product_variant_values.product_id = 525;";
      $result = $this->_conn->MySQLi()->query($sql);
      return $result->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function recommendedProducts($recommendedProducts)
  {
    $result = [];
    try {
      if (empty($recommendedProducts)) {
        return $result;
      }
      $sql = "SELECT products.* , categories.name AS category_name 
                    FROM products
                    INNER JOIN categories ON products.category_id = categories.id
                    WHERE products.name IN ($recommendedProducts) 
                      AND products.status = " . self::STATUS_ENABLE . "
                    AND categories.status = " . self::STATUS_ENABLE;
      $queryResult = $this->_conn->MySQLi()->query($sql);

      if ($queryResult) {
        $result = $queryResult->fetch_all(MYSQLI_ASSOC);
      }
      return $result;
    } catch (\Throwable $th) {
      // Ghi log lỗi nếu có
      error_log('Lỗi khi hiển thị các sản phẩm được gợi ý: ' . $th->getMessage());
      return $result;
    }
  }
  public function getProductByWatched($ids)
  {
    $result = [];
    try {
      $sql = "SELECT products.*, categories.name AS category_name 
                FROM products 
                INNER JOIN categories ON products.category_id = categories.id
                WHERE products.id IN ($ids) AND products.status = " . self::STATUS_ENABLE . "
                AND categories.status = " . self::STATUS_ENABLE;

      $result = $this->_conn->MySQLi()->query($sql);
      return $result->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị các sản phẩm có lượt xem nhiều nhất: ' . $th->getMessage());
      return $result;
    }
  }
  public function SettingVariantByProductId($id)
  {
    $result = [];
    try {
      $sql = "SELECT product_variant_values.product_id AS product_id, product_variant_values.id AS id_varaiant_value, products.name AS product_name, product_variants.name AS variant_name, product_variant_options.name AS value_variant, product_variant_values.product_variant_id AS variant_id FROM `products` INNER JOIN product_variant_values on products.id = product_variant_values.product_id INNER JOIN product_variant_options on product_variant_values.option_id = product_variant_options.id INNER JOIN product_variants on product_variant_options.product_variant_id = product_variants.id WHERE product_variant_values.product_id = $id";
      $result = $this->_conn->MySQLi()->query($sql);
      return $result->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function DetailVariant($id)
  {
    $result = [];
    try {
      $sql = "SELECT products.name AS product_name, products.id AS product_id FROM `product_variant_values` INNER JOIN product_variant_options on product_variant_values.option_id = product_variant_options.id INNER JOIN products on product_variant_values.product_id = products.id WHERE product_variant_values.combination_id = $id";
      $result = $this->_conn->MySQLi()->query($sql);
      return $result->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function SelectProductVariantValueID($productID, array $variants, array $variant_ids)
  {
    $result = [];
    try {
      // Escape các giá trị để tránh SQL Injection
      $product_id = $this->_conn->MySQLi()->real_escape_string($productID);

      // Chuẩn bị danh sách variant_ids và variants
      $escaped_variant_ids = array_map([$this->_conn->MySQLi(), 'real_escape_string'], $variant_ids);
      $escaped_variants = array_map([$this->_conn->MySQLi(), 'real_escape_string'], $variants);

      // Tạo chuỗi điều kiện `IN` cho mảng
      $variant_ids_condition = "'" . implode("','", $escaped_variant_ids) . "'";
      $variants_condition = "'" . implode("','", $escaped_variants) . "'";

      // Tạo câu truy vấn
      $sql = "SELECT product_variant_values.id AS product_variant_values_id
                FROM `product_variant_values`
                INNER JOIN product_variant_options
                    ON product_variant_values.option_id = product_variant_options.id
                WHERE product_variant_values.product_variant_id IN ($variant_ids_condition)
                  AND product_variant_options.name IN ($variants_condition)
                  AND product_variant_values.product_id = '$product_id'";

      // Thực thi truy vấn
      $query = $this->_conn->MySQLi()->query($sql);
      if ($query) {
        $result = $query->fetch_all(MYSQLI_ASSOC);
      }
      return $result;
    } catch (\Throwable $th) {
      error_log('Lỗi không tìm thấy: ' . $th->getMessage());
      return $result;
    }
  }

  public function InsertCombinationID($variant_value_id)
  {
    $conn = $this->_conn->MySQLi(); // Giữ kết nối MySQLi
    $data = $variant_value_id;

    // Tìm ID lớn nhất hiện tại trong bảng và tăng thêm 1
    $result = $conn->query("SELECT MAX(id) AS max_id FROM product_variant_option_combination");
    $row = $result->fetch_assoc();
    $next_id = isset($row['max_id']) ? $row['max_id'] + 1 : 1; // Nếu bảng rỗng, bắt đầu từ 1

    // Chèn bản ghi mới với ID là $next_id
    $stmt = $conn->prepare("INSERT INTO product_variant_option_combination (id) VALUES (?)");
    $stmt->bind_param('i', $next_id);
    $stmt->execute();

    // Lấy ID tự động tăng vừa được chèn
    $combination_id = $next_id;
    $_SESSION['id_combination'] = $combination_id;
    // Duyệt qua từng phần tử trong mảng $data và cập nhật bảng product_variant_values
    echo '<pre>';
    foreach ($data as $item) {
      if (isset($item['product_variant_values_id'])) {
        // Kiểm tra và ép kiểu dữ liệu
        $variant_ids = is_array($item['product_variant_values_id'])
          ? array_map('intval', $item['product_variant_values_id'])
          : [(int) $item['product_variant_values_id']];
        // Cập nhật bảng product_variant_values
        foreach ($variant_ids as $variant_id) {
          $sql = "UPDATE product_variant_values SET combination_id = ? WHERE id = ?";
          $updateStmt = $conn->prepare($sql);
          if (!$updateStmt) {
            throw new \Exception("Lỗi khi chuẩn bị câu lệnh: " . $conn->error);
          }
          $updateStmt->bind_param('ii', $combination_id, $variant_id);
          if (!$updateStmt->execute()) {
            throw new \Exception("Lỗi khi thực thi câu lệnh: " . $updateStmt->error);
          }
          $updateStmt->close(); // Đóng statement sau mỗi lần cập nhật
        }
      }
    }

    // Trả về kết quả thành công
    return true;
  }


  public function createSku($data)
  {
    try {
      // Lấy giá trị id lớn nhất hiện tại
      $conn = $this->_conn->MySQLi();

      if (!$conn) {
        throw new \Exception('Không thể kết nối cơ sở dữ liệu: ' . mysqli_connect_error());
      }

      $result = $conn->query("SELECT MAX(id) AS max_id FROM skus");

      if (!$result) {
        throw new \Exception('Lỗi khi truy vấn giá trị lớn nhất: ' . $conn->error);
      }

      $row = $result->fetch_assoc();
      $newId = ($row['max_id'] ?? 0) + 1;
      $_SESSION['sku_id'] = $newId;
      // Chuẩn bị câu lệnh SQL INSERT
      $sql = "INSERT INTO skus (id, name, sku, description, price, image, product_id) VALUES (?, ?, ?, ?, ?, ?, ?)";

      // Chuẩn bị statement
      $stmt = $conn->prepare($sql);

      if (!$stmt) {
        throw new \Exception('Lỗi khi chuẩn bị câu lệnh: ' . $conn->error);
      }

      // Gắn các giá trị vào statement
      $stmt->bind_param(
        "isssssi", // i: integer, s: string
        $newId,
        $data['name'],
        $data['sku'],
        $data['description'],
        $data['price'],
        $data['image'],
        $data['product_id']
      );

      // Thực hiện câu lệnh
      if (!$stmt->execute()) {
        throw new \Exception('Lỗi khi thực thi câu lệnh: ' . $stmt->error);
      }

      // Đóng statement
      $stmt->close();

      return true;
    } catch (\Throwable $th) {
      error_log('Lỗi khi chèn dữ liệu vào bảng skus: ' . $th->getMessage());
      return false;
    }
  }
  public function addFkSku($id, $sku_id)
  {
    try {
      // Kết nối cơ sở dữ liệu
      $conn = $this->_conn->MySQLi();
      if (!$conn) {
        throw new \Exception('Không thể kết nối cơ sở dữ liệu: ' . mysqli_connect_error());
      }

      // Chuẩn bị câu lệnh SQL UPDATE
      $sql = "UPDATE product_variant_option_combination SET sku_id = ? WHERE id = ?";

      // Chuẩn bị statement
      $stmt = $conn->prepare($sql);

      if (!$stmt) {
        throw new \Exception('Lỗi khi chuẩn bị câu lệnh: ' . $conn->error);
      }

      // Gắn các giá trị vào statement
      $stmt->bind_param("ii", $sku_id, $id); // "ii" cho 2 giá trị kiểu integer

      // Thực hiện câu lệnh
      if (!$stmt->execute()) {
        throw new \Exception('Lỗi khi thực thi câu lệnh: ' . $stmt->error);
      }

      // Đóng statement
      $stmt->close();

      return true;
    } catch (\Throwable $th) {
      error_log('Lỗi khi cập nhật dữ liệu trong bảng product_variant_option_combination: ' . $th->getMessage());
      return false;
    }
  }
  public function getAllAttribute($id)
  {
    $result = [];
    try {
      $sql = "SELECT * FROM `product_variants` WHERE product_variants.id = $id";
      $result = $this->_conn->MySQLi()->query($sql);
      return $result->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function getAllAttributeAndOptionName($id)
  {
    $result = [];
    try {
      $sql = "SELECT product_variants.name AS variant_name, product_variant_options.id AS variant_option_id ,product_variant_options.name AS variant_option_name FROM `product_variants` INNER JOIN  product_variant_options on product_variants.id = product_variant_options.product_variant_id WHERE product_variants.id = $id";
      $result = $this->_conn->MySQLi()->query($sql);
      return $result->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function updateAttribute($data, $table)
  {
    $tb = $table;
    $name = $data['name'];
    $id = $data['id'];
    try {
      // Kết nối cơ sở dữ liệu
      $conn = $this->_conn->MySQLi();
      if (!$conn) {
        throw new \Exception('Không thể kết nối cơ sở dữ liệu: ' . mysqli_connect_error());
      }

      // Chuẩn bị câu lệnh SQL UPDATE
      $sql = "UPDATE $tb SET name = ? WHERE id = ?";
      // Chuẩn bị statement
      $stmt = $conn->prepare($sql);

      if (!$stmt) {
        throw new \Exception('Lỗi khi chuẩn bị câu lệnh: ' . $conn->error);
      }

      // Gắn các giá trị vào statement
      $stmt->bind_param("si", $name, $id); // "ii" cho 2 giá trị kiểu integer

      // Thực hiện câu lệnh
      if (!$stmt->execute()) {
        throw new \Exception('Lỗi khi thực thi câu lệnh: ' . $stmt->error);
      }

      // Đóng statement
      $stmt->close();

      return true;
    } catch (\Throwable $th) {
      error_log('Lỗi khi cập nhật dữ liệu trong bảng product_variant_option_combination: ' . $th->getMessage());
      return false;
    }
  }
  public function delAttribute($data, $table)
  {
    $tb = $table;
    $status = $data['status'];
    $id = $data['id'];
    try {
      // Kết nối cơ sở dữ liệu
      $conn = $this->_conn->MySQLi();
      if (!$conn) {
        throw new \Exception('Không thể kết nối cơ sở dữ liệu: ' . mysqli_connect_error());
      }

      // Chuẩn bị câu lệnh SQL UPDATE
      $sql = "UPDATE $tb SET status = ? WHERE id = ?";
      // Chuẩn bị statement
      $stmt = $conn->prepare($sql);

      if (!$stmt) {
        throw new \Exception('Lỗi khi chuẩn bị câu lệnh: ' . $conn->error);
      }

      // Gắn các giá trị vào statement
      $stmt->bind_param("si", $status, $id); // "ii" cho 2 giá trị kiểu integer

      // Thực hiện câu lệnh
      if (!$stmt->execute()) {
        throw new \Exception('Lỗi khi thực thi câu lệnh: ' . $stmt->error);
      }

      // Đóng statement
      $stmt->close();

      return true;
    } catch (\Throwable $th) {
      error_log('Lỗi khi cập nhật dữ liệu trong bảng product_variant_option_combination: ' . $th->getMessage());
      return false;
    }
  }
  public function getSkuId($id)
  {
    $result = [];
    try {
      $sql = "SELECT product_variant_values.combination_id, skus.id AS sku_id, product_variant_options.name AS option_name, product_variants.name AS variant_name, skus.price AS price  FROM `skus` INNER JOIN product_variant_option_combination on skus.id = product_variant_option_combination.sku_id INNER JOIN product_variant_values on product_variant_option_combination.id = product_variant_values.combination_id INNER JOIN product_variant_options on product_variant_values.option_id = product_variant_options.id INNER JOIN product_variants on product_variant_options.product_variant_id = product_variants.id WHERE product_variant_values.id IN ($id);";
      // Thực hiện truy vấn
      $queryResult = $this->_conn->MySQLi()->query($sql);

      // Kiểm tra kết quả truy vấn
      if ($queryResult === false) {
        throw new \Exception('Lỗi truy vấn SQL: ' . $this->_conn->MySQLi()->error);
      }

      // Trả về kết quả dạng mảng liên kết
      return $queryResult->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function getAllSkuByProductId($id)
  {
    $result = [];
    try {
      $sql = "SELECT * FROM `skus` WHERE product_id = $id AND status = 1";

      // Thực hiện truy vấn
      $queryResult = $this->_conn->MySQLi()->query($sql);

      // Kiểm tra kết quả truy vấn
      if ($queryResult === false) {
        throw new \Exception('Lỗi truy vấn SQL: ' . $this->_conn->MySQLi()->error);
      }

      // Trả về kết quả dạng mảng liên kết
      return $queryResult->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function getAllSkuById($id)
  {
    $result = [];
    try {
      $sql = "SELECT * FROM `skus` WHERE id = $id";

      // Thực hiện truy vấn
      $queryResult = $this->_conn->MySQLi()->query($sql);

      // Kiểm tra kết quả truy vấn
      if ($queryResult === false) {
        throw new \Exception('Lỗi truy vấn SQL: ' . $this->_conn->MySQLi()->error);
      }

      // Trả về kết quả dạng mảng liên kết
      return $queryResult->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
      error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
      return $result;
    }
  }
  public function updateSku(int $id, array $data)
  {
    try {
      $sql = "UPDATE skus SET ";
      foreach ($data as $key => $value) {
        $sql .= "$key = '$value', ";
      }
      $sql = rtrim($sql, ", ");

      $sql .= " WHERE $this->id=$id";
      $conn = $this->_conn->MySQLi();
      $stmt = $conn->prepare($sql);
      return $stmt->execute();
    } catch (\Throwable $th) {
      error_log('Lỗi khi cập nhật dữ liệu: ', $th->getMessage());
      return false;
    }
  }
  public function createOptionNamVariant($data)
  {
    try {

      $conn = $this->_conn->MySQLi();
      if (!$conn) {
        throw new \Exception('Không thể kết nối cơ sở dữ liệu');
      }

      // Sử dụng prepared statement để bảo mật
      $stmt = $conn->prepare("INSERT INTO product_variant_options (product_variant_id, name ) VALUES (?, ?)");
      if (!$stmt) {
        throw new \Exception('Lỗi chuẩn bị câu lệnh SQL: ' . $conn->error);
      }

      // Gán tham số vào câu lệnh và thực thi
      $product_variant_id = $data['product_variant_id'];
      $name = $data['name'];
      $stmt->bind_param("is", $product_variant_id, $name);
      if (!$stmt->execute()) {
        throw new \Exception('Lỗi thực thi câu lệnh SQL: ' . $stmt->error);
      }

      // Lấy ID bản ghi vừa thêm
      $insert_id = $stmt->insert_id;

      // Đóng tài nguyên
      $stmt->close();
      $conn->close();

      // Trả về ID bản ghi vừa thêm
      return $insert_id;
    } catch (\Throwable $th) {
      error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
      return false;
    }
  }
}
