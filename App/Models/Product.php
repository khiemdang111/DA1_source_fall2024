<?php

namespace App\Models;

class Product extends BaseModel
{
    protected $table = 'products';
    protected $id = 'id';

    public function getAllProduct()
    {
        return $this->getAll();
    }
    public function getOneProduct($id)
    {
        return $this->getOne($id);
    }

    public function createProduct($data)
    {
        return $this->create($data);
    }
    public function updateProduct($id, $data)
    {
        return $this->update($id, $data);
    }
    public function countTotalProduct()
    {
        return $this->countTotal();
    }
    public function deleteProduct($id)
    {
        return $this->delete($id);
    }
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
    public function countProductByCategory()
    {
        $result = [];
        try {
            $sql = "SELECT COUNT(*) AS count,categories.name FROM products INNER JOIN categories on products.category_id = categories.id GROUP BY products.category_id;";

            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getTopViewedProducts()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table ORDER BY view DESC LIMIT 5";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị các sản phẩm có lượt xem nhiều nhất: ' . $th->getMessage());
            return $result;
        }
    }
    public function search($keyword)
{
    $sql = "SELECT products.* , categories.name AS category_name 
                FROM products
                INNER JOIN categories ON products.category_id = categories.id
                WHERE products.name REGEXP '$keyword' 
                AND products.status = " . self::STATUS_ENABLE . "
                AND categories.status = " . self::STATUS_ENABLE;
    $result = $this->_conn->MySQLi()->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}




    public function getAllProductByStatusRecycle()
    {
        $result = [];
        try {
            $sql = "SELECT products.*, categories.name AS category_name FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.status= 0";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAllProductByVariant()
    {
        $result = [];
        try {
            $sql = "SELECT products.*, product_variants.id AS product_variant_id, product_variants.name AS product_variant_name  FROM `products` INNER JOIN product_variants on products.id = product_variants.product_id;";
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
            $sql = "SELECT product_variant_options.*, products.id AS pro_id, product_variants.name AS pro_variant_name , product_variants.id AS pro_variant_id FROM product_variant_options INNER JOIN product_variants on product_variant_options.product_variant_id = product_variants.id INNER JOIN products on product_variants.product_id = products.id;";
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
            $sql = "SELECT product_variants.*, product_variant_options.name AS option_name FROM `product_variants` INNER JOIN product_variant_options on product_variants.id = product_variant_options.product_variant_id;";
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
            $sql = "SELECT product_variants.name AS variant_name, product_variant_options.name AS option_name FROM `product_variant_values` INNER JOIN `product_variant_options` ON product_variant_values.option_id = product_variant_options.id INNER JOIN `product_variants` ON product_variants.id = product_variant_options.product_variant_id WHERE product_variant_values.product_id = $id";
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
    public function updateCombinatioValue($groupedData)
{
    $conn = $this->_conn->MySQLi();  // Giữ kết nối MySQLi
    $data = $groupedData;

    // Get the last inserted ID and increment it by 1
    $query = "SELECT MAX(id) FROM product_variant_option_combination";
    $result = $conn->query($query);
    $lastId = $result->fetch_row()[0];
    $newId = $lastId + 1;

    foreach ($data as $item) {
        // Bước 1: Chèn group_id vào bảng compostr
        $stmt = $conn->prepare("INSERT INTO product_variant_option_combination (id) VALUES (?)");
        $stmt->bind_param('i', $newId);
        $stmt->execute();
  
        // Lấy id của bản ghi vừa chèn
        $combination_id = $conn->insert_id;

        // Bước 2: Cập nhật bảng value với combination_id
        foreach ($item['id_variant_values'] as $variant_id) {
            // Cập nhật combination_id vào bảng value nếu id trùng với id_variant_values
            $updateStmt = $conn->prepare("UPDATE product_variant_values SET combination_id = ? WHERE id = ?");
            $updateStmt->bind_param('ii', $combination_id, $variant_id);
            $updateStmt->execute();
        }

        $newId++;
    }
}

    public function getProductsWithFilters($filters = [])
    {
        $result = [];
        try {

            $query = "SELECT products.*, categories.name AS category_name
                  FROM products
                  INNER JOIN categories ON products.category_id = categories.id
                  WHERE products.status = " . self::STATUS_ENABLE . "
                  AND categories.status = " . self::STATUS_ENABLE;

            if (!empty($filters['categories'])) {
                $categories = implode(',', array_map('intval', (array) $filters['categories']));
                $query .= " AND category_id IN ($categories)";
            }

            if (!empty($filters['origin'])) {
                $origin = implode(',', array_map('intval', (array) $filters['origin']));
                $query .= " AND origin_id IN ($origin)";
            }

            if (!empty($filters['price'])) {
                $priceRange = explode('-', $filters['price']);
                if (count($priceRange) === 2) {
                    $minPrice = intval($priceRange[0]);
                    $maxPrice = intval($priceRange[1]);
                    $query .= " AND price BETWEEN $minPrice AND $maxPrice";
                }
            }

            if (!empty($filters['sort'])) {
                if ($filters['sort'] == 1) {
                    $query .= " ORDER BY price DESC";
                } elseif ($filters['sort'] == 2) {
                    $query .= " ORDER BY price ASC";
                } elseif ($filters['sort'] == 3) {
                    $query .= " ORDER BY view DESC";
                }
            }

            $result = $this->_conn->MySQLi()->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
}
