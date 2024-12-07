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
            $sql = "SELECT products.*, categories.name AS category_name
            FROM products
            INNER JOIN categories ON products.category_id = categories.id
            WHERE products.status = " . self::STATUS_ENABLE . " 
              AND categories.status = " . self::STATUS_ENABLE . "
            ORDER BY products.id DESC";

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
                $categories =  $filters['categories'];
                $query .= " AND category_id IN ($categories)";
            }

            if (!empty($filters['origin'])) {
                $origin = $filters['origin'];
                $query .= " AND origin  = '$origin'";
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
    public function getAllProductLimit8()
    {
        $result = [];
        try {
            $sql = "SELECT products.*, categories.name AS category_name FROM $this->table INNER JOIN categories on products.category_id = categories.id WHERE products.status = " . self::STATUS_ENABLE . "  ORDER BY id DESC LIMIT 7";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAllProductByPagina()
    {
        $pages = isset($_GET['pages']) ? intval($_GET['pages']) : 1;

        $row = 10; 
        $from = ($pages - 1) * $row;
        
        $result = [];
        try {
            $sql = "SELECT products.*, categories.name AS category_name
            FROM products
            INNER JOIN categories ON products.category_id = categories.id
            WHERE products.status = " . self::STATUS_ENABLE . " 
              AND categories.status = " . self::STATUS_ENABLE . "
            ORDER BY products.id DESC LIMIT " . $from. ",". $row;

            $count = "SELECT COUNT(id) AS total FROM $this->table WHERE $this->table.status = 1";
            $result_count = $this->_conn->MySQLi()->query($count);

            // Lấy tổng số bài viết
            $total = $result_count->fetch_assoc()['total'];
            $result = $this->_conn->MySQLi()->query($sql);
             return [
                'products' => $result->fetch_all(MYSQLI_ASSOC), // Lấy danh sách bài viết
                'total' => intval($total), // Tổng số bài viết
                'current_page' => $pages, // Trang hiện tại
                'total_pages' => ceil($total / $row) // Tổng số trang
            ];
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
}