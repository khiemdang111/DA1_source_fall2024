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
            $sql = "SELECT product_variant_values.id
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

        // Chèn bản ghi mới vào bảng product_variant_option_combination
        $stmt = $conn->prepare("INSERT INTO product_variant_option_combination (id) VALUES (NULL)");
        $stmt->execute();

        // Lấy ID tự động tăng vừa được chèn
        $combination_id = $conn->insert_id;
        $_SESSION['id_combination'] = $combination_id;
        // Duyệt qua từng phần tử trong mảng data và cập nhật bảng product_variant_values
        foreach ($data as $item) {
            if (isset($item['id'])) {
                $variant_id = (int) $item['id']; // Lấy ID của variant hiện tại

                // Bước 2: Cập nhật bảng value với combination_id
                foreach ($item['id_variant_values'] as $variant_id) {
                    // Cập nhật combination_id vào bảng value nếu id trùng với id_variant_values
                    $updateStmt = $conn->prepare("UPDATE product_variant_values SET combination_id = ? WHERE id = ?");
                    $updateStmt->bind_param('ii', $combination_id, $variant_id);
                    $updateStmt->execute();
                }
            }
        }

    
}
}