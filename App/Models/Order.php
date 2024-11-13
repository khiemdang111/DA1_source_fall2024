<?php

namespace App\Models;

class Order extends BaseModel
{
    protected $table = 'order_detail';
    protected $id = 'id';

    public function getAllorder()
    {
        return $this->getAll();
    }
    public function getOneorder($id)
    {
        return $this->getOne($id);
    }

    public function createorder($data)
    {
        return $this->create($data);
    }
    public function updateorder($id, $data)
    {
        return $this->update($id, $data);
    }
    public function countTotalorder()
    {
        return $this->countTotal();
    }
    public function deleteorder($id)
    {
        return $this->delete($id);
    }
   
    
}   
