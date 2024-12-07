<?php

namespace App\Models;

class Vourcher extends BaseModel
{
    protected $table = 'discount_codes';
    protected $id = 'id';

    public function getAllDiscount_codes()
    {
        return $this->getAll();
    }
    public function getOneDiscount_codes($id)
    {
        return $this->getOne($id);
    }

    public function createDiscount_codes($data)
    {
        return $this->create($data);
    }
    public function updateDiscount_codes($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteDiscount_codes($id)
    {
        return $this->delete($id);
    }
    public function getAllDiscount_codesByStatus()
    {
        return $this->getAllByStatus();
    }
    public function getAllByStatus()
    {
        $sql = "SELECT * FROM $this->table WHERE status = 1";
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getOneCategoryByName($name)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE name=?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('s', $name);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy loại sản phẩm bằng tên: ' . $th->getMessage());
            return $result;
        }
    }
    public function countTotalCategory()
    {
        return $this->countTotal();
    }
    public function getAlldiscount_codesJoinUser()
    {
        $result = [];
        try {
            $sql = "SELECT discount_codes.*,  users.username FROM discount_codes 
       
        INNER JOIN users ON discount_codes.user_id=users.id";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());

            return $result;
        }
    }




    public function getAllCategoryProductByStatus(int $id)
    {



        $result = [];
        try {
            $sql = "SELECT products.*, categories.name AS category_name 
                 FROM products 
                 INNER JOIN categories ON products.category_id = categories.id WHERE categories.status != 0 AND products.category_id = $id";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }



    public function search($keyword)
    {
        $sql = "SELECT discount_codes.*,  users.username FROM discount_codes
             INNER JOIN users ON discount_codes.user_id=users.id
        WHERE discount_codes.name REGEXP '$keyword' ";
        $result = $this->_conn->MySQLi()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
