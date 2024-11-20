<?php

namespace App\Models;

class Origin extends BaseModel
{
    protected $table = 'origins';
    protected $id = 'id';

    public function getAllOrigins()
    {
        return $this->getAll();
    }
    public function getOneOrigins($id)
    {
        return $this->getOne($id);
    }

    public function createOrigins($data)
    {
        return $this->create($data);
    }
    public function updateOrigins($id, $data)
    {
        return $this->update($id, $data);
    }
    public function countTotalOrigins()
    {
        return $this->countTotal();
    }
    public function deleteOrigins($id)
    {
        return $this->delete($id);
    }
    public function getAllOriginsByStatus()
{
    $result = [];
    try {
        // Sửa lỗi cú pháp SQL
        $sql = "SELECT * FROM origins WHERE status = " . self::STATUS_ENABLE;
        
        // Kiểm tra kết quả truy vấn
        $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
}

   
    
    
}   
