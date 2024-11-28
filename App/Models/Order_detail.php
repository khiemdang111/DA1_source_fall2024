<?php

namespace App\Models;

class Order_detail extends BaseModel
{
    protected $table = 'order_detail';
    protected $id = 'id';
    public function getAllOrder_id(int $id)
    {
        $result = [];
        try {
            $sql = "SELECT order_detail.id AS order_detail_id, order_detail.*, orders.id ,orders.phone ,orders.total,orders.date as oders_date, orders.name,orders.orderStatus, orders.paymentMethod, orders.address, orders.ward, orders.district, orders.province, orders.user_id ,products.name AS product_name, 
            products.image AS product_image FROM order_detail INNER JOIN orders ON orders.id = order_detail.order_id INNER JOIN products ON products.id = order_detail.product_id WHERE order_detail.order_id = ? and orders.user_id =".$_SESSION['user']['id'];
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
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
