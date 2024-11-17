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
    // public function searchProduct($keyword) {
    //     $result = [];
    //     try {
    //         // Kết nối tới cơ sở dữ liệu
    //         $conn = $this->_conn->MySQLi();

    //         // Câu truy vấn tìm kiếm, sử dụng các tham số ràng buộc để ngăn chặn SQL injection
    //         $sql = "SELECT products.*, categories.name as name_cate 
    //                 FROM products 
    //                 INNER JOIN categories ON products.category_id = categories.id 
    //                 WHERE products.name LIKE ? OR categories.name LIKE ?";

    //         // Chuẩn bị câu truy vấn
    //         $stmt = $conn->prepare($sql);
    //         // Tạo từ khóa tìm kiếm với ký tự `%` ở đầu và cuối
    //         $keyword = '%' . $keyword . '%';

    //         // Ràng buộc các tham số
    //         $stmt->bind_param('ss', $keyword, $keyword);

    //         // Thực thi câu truy vấn
    //         $stmt->execute();

    //         // Lấy kết quả
    //         $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    //         // Đóng câu lệnh
    //         $stmt->close();
    //     } catch (\Throwable $th) {
    //         // Ghi lại lỗi nếu có
    //         error_log('Lỗi khi tìm kiếm sản phẩm: ' . $th->getMessage());
    //     }

    //     // Trả về kết quả
    //     return $result;

    // }


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
    public function getRelatedProducts(int $id, int $category_id)
{
    $result = [];
    try {
        $sql = "SELECT products.*, categories.name AS category_name 
                FROM products 
                INNER JOIN categories ON products.category_id = categories.id 
                WHERE products.status = " . self::STATUS_ENABLE . " 
                  AND categories.status = " . self::STATUS_ENABLE . " 
                  AND products.id != ? 
                  AND products.category_id = ?
                LIMIT 4";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $id, $category_id);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    } catch (\Throwable $th) {
        error_log('Lỗi khi lấy sản phẩm liên quan: ' . $th->getMessage());
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
            header('Location: /admin/productvariant/{$product_id}');
            return true;
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
    }
    

}
