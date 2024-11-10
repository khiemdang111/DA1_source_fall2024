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
            $sql = "SELECT products.*,categories.name AS category_name FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.status !=" . self::STATUS_DISABLE ." ";
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
    
    
    
    
}   
