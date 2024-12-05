<?php

namespace App\Models;

use App\Helpers\NotificationHelper;

class Category_post extends BaseModel
{
    protected $table = 'post_categories';
    protected $id = 'id';



    public function getAllCatrgoty_Post()
    {
        return $this->getAll();
    }
    public function getOneCatrgoty_Post($id)
    {
        return $this->getOne($id);
    }

    public function createCatrgoty_Post($data)
    {
        return $this->create($data);
    }
    public function updateCatrgoty_Post($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCatrgoty_Post($id)
    {
        return $this->delete($id);
    }
   

   
}