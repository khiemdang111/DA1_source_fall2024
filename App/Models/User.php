<?php

namespace App\Models;

use App\Helpers\NotificationHelper;

class User extends BaseModel
{
    protected $table = 'users';
    protected $id = 'id';



    public function getAllUser()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM users WHERE status != 0 AND status !=3";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    
    }
    public function getOneUser($id)
    {
        return $this->getOne($id);
    }

    public function createUser($data)
    {
        return $this->create($data);
    }
    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->delete($id);
    }
    public function getAllCategoryByStatus()
    {
        return $this->getAllByStatus();
    }
    public function countTotalUser()
    {
        return $this->countTotal();
    }
    public function getOneUserByUsername(string $username)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM users WHERE username=?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('s', $username);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getAllUserByStatusRecycle()
    {
        $result = [];
        try {
            $sql = "SELECT users.* FROM users  WHERE status= 0";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getOneUserByInfo($column, $info)
    {
        $this->id = $column;
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE $this->id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $info);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Đã xảy ra lỗi khi lấy dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }


    public function updatePasswordByUsername(string $username, string $hashedPassword)
    {
        try {
            $sql = "UPDATE users SET password = ? WHERE username = ?";
            $conn = $this->_conn->MySQLi(); // Giả sử bạn đã khởi tạo kết nối MySQLi trong lớp
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new \Exception("Không thể chuẩn bị câu lệnh: " . $conn->error);
            }

            $stmt->bind_param('ss', $hashedPassword, $username);
            $result = $stmt->execute();

            if (!$result) {
                throw new \Exception("Lỗi khi thực thi câu lệnh: " . $stmt->error);
            }

            return true;
        } catch (\Throwable $th) {
            error_log("Lỗi khi cập nhật mật khẩu: " . $th->getMessage());
            return false;
        }
    }
    public function getOneToken(int $token)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE token=?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('i', $token);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function search($keyword)
    {
        $sql = "SELECT users.* FROM users WHERE users.name REGEXP '$keyword' OR users.phone REGEXP '$keyword' OR users.email REGEXP '$keyword' OR users.address REGEXP '$keyword' OR users.username REGEXP '$keyword' ";
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserId(int $id)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE id=?";
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
  
    public function updateUserPointsNew(int $id , $new_points)
    {
        $result = [];
        try {
            $sql = "UPDATE users SET accumulate_points = ? WHERE id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('ii', $new_points , $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getOneUserByWallet(string $id)
    {
        $result = [];
        try {
            $sql = "SELECT orders.total, users.id AS user_id FROM `orders` INNER JOIN users on orders.user_id =  users.id WHERE orders.user_id = ? AND orders.paymentMethod = 'VNPAY' AND orders.transport = 0";
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
    public function addMoneyWallet(int $id, int $balance)
    {
        try {
            $sql = "UPDATE users SET balance = balance + ? WHERE id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('ii', $balance, $id);
            $stmt->execute();

            // Kiểm tra số dòng bị ảnh hưởng
            if ($stmt->affected_rows > 0) {
                return ['success' => true, 'message' => 'Balance updated successfully'];
            } else {
                return ['success' => false, 'message' => 'No rows updated'];
            }
        } catch (\Throwable $th) {
            error_log('Error updating balance: ' . $th->getMessage());
            return ['success' => false, 'message' => 'An error occurred'];
        }
    }



    public function updateUserPoints($user_id, $points, $turns)
    {
       
        $sql = "UPDATE users SET accumulate_points = ?, turns = turns + ? WHERE id = ?";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iii', $points, $turns, $user_id);
        return $stmt->execute();
    }
}