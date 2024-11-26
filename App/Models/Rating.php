<?php

namespace App\Models;

class Rating extends BaseModel
{
    protected $table = 'ratings';
    protected $id = 'id';

    public function getAllRatings()
    {
        return $this->getAll();
    }
    public function getOneRatings($id)
    {
        return $this->getOne($id);
    }

    public function createRatings($data)
    {
        return $this->create($data);
    }
    public function updateRatings($id, $data)
    {
        return $this->update($id, $data);
    }
    public function countTotalRatings()
    {
        return $this->countTotal();
    }
    public function deleteRatings($id)
    {
        return $this->delete($id);
    }
    public function getAllRatingsByStatus()
    {
        $result = [];
        try {
            // Sửa lỗi cú pháp SQL
            $sql = "SELECT * FROM Ratings WHERE status = " . self::STATUS_ENABLE;

            // Kiểm tra kết quả truy vấn
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function get5RatingNewestByProductAndStatus($id)
    {
        $result = [];
        try {
            $sql = "SELECT ratings.*, users.username, users.name, users.avatar 
                FROM ratings 
                INNER JOIN users ON ratings.user_id = users.id 
                WHERE ratings.product_id = ? AND ratings.status = ? 
                ORDER BY ratings.created DESC 
                LIMIT 5;";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            if ($stmt) {

                $status = self::STATUS_ENABLE;
                $stmt->bind_param('ii', $id, $status);

                if ($stmt->execute()) {
                    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                }
                $stmt->close();
            }
            $conn->close();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
        }
        return $result;
    }

    public function getAverageRatingByProduct($id)
    {
        $result = [];
        try {
            $sql = "SELECT rating, COUNT(*) as total_reviews,
            COUNT(*) * 100.0 / (SELECT COUNT(*) FROM ratings WHERE product_id = ?) as percentage 
                FROM ratings 
                WHERE product_id = ? 
                GROUP BY rating 
                ORDER BY rating DESC;
            ";
    
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            
            if ($stmt) {
             
                $stmt->bind_param('ii', $id, $id);
    
                if ($stmt->execute()) {
                    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                }
                $stmt->close();
            }
            $conn->close();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
        }
        return $result;
    }

    public function countRatingByProduct($id)
{
    $result = [];
    try {
        $sql = "SELECT COUNT(*) as total_reviews FROM ratings WHERE product_id = ?";
        
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);   
        $stmt->bind_param('i', $id);  
        $stmt->execute();
    
        $result = $stmt->get_result()->fetch_assoc();     
        $stmt->close();  
        $conn->close();  
    } catch (\Throwable $th) {
        error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage()); 
    }
    
    return $result; 
}

    





}
