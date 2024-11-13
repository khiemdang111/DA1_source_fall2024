<?php

namespace App\Models;


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

    public function getOnePostByName($name)
    {
        return $this->getOneByName($name);
    }
   
    public function getAllPostByStatusRecycle()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM posts WHERE status= 0";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
   
}