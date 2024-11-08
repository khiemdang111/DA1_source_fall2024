<?php

namespace App\Models;

use App\Helpers\NotificationHelper;

class Post extends BaseModel
{
    protected $table = 'posts';
    protected $id = 'id';



    public function getAllPost()
    {
        return $this->getAll();
    }
    public function getOnePost($id)
    {
        return $this->getOne($id);
    }

    public function createPost($data)
    {
        return $this->create($data);
    }
    public function updatePost($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deletePost($id)
    {
        return $this->delete($id);
    }
   

   
}