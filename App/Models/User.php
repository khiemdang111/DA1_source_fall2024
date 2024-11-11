<?php

namespace App\Models;

use App\Helpers\NotificationHelper;

class User extends BaseModel
{
    protected $table = 'users';
    protected $id = 'id';



    public function getAllUser()
    {
        return $this->getAll();
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
}