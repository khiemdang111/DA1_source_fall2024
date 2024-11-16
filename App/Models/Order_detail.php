<?php

namespace App\Models;

class Order_detail extends BaseModel
{
    protected $table = 'order_detail';
    protected $id = 'id';
    public function getAllorderDetail()
    {
        return $this->getAll();
    }
    public function getOneorderDetail($id)
    {
        return $this->getOne($id);
    }

    public function createorderDetail($data)
    {
        return $this->create($data);
    }
    public function updateorderDetail($id, $data)
    {
        return $this->update($id, $data);
    }
    public function countTotalorderDetail()
    {
        return $this->countTotal();
    }
    public function deleteorderDetail($id)
    {
        return $this->delete($id);
    }
   
    
}   
