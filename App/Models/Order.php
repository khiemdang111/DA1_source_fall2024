<?php

namespace App\Models;

class Order extends BaseModel
{
    protected $table = 'orders';
    protected $id = 'id';

    public function getAllorder()
    {
        return $this->getAll();
    }
    public function getAllOrder_ByStatus($user_id, $status)
    {
        $result = [];
        try {
            $sql = "SELECT orders.id, orders.total, orders.orderStatus, orders.date, orders.paymentMethod, orders.user_id , orders.transport
                    FROM orders 
                    WHERE orders.user_id = ? AND orders.transport = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $transport, $user_id);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }

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
    public function getAllOrderbyUser_id()
    {
        $result = [];
        try {
            $sql = "SELECT orders.id,orders.total,orders.orderStatus,orders.date,orders.paymentMethod,orders.user_id FROM orders WHERE orders.user_id =" . $_SESSION['user']['id'] . " AND orders.transport =2";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAllOrderbyUser_id_admin($id)
    {
        $result = [];
        try {
            $sql = "SELECT orders.id,orders.total,orders.orderStatus,orders.date,orders.paymentMethod,orders.user_id FROM orders WHERE orders.user_id = ?";
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
    public function createOder(array $data)
    {
        // $sql ="INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1')";

        // $result = $this->_conn->connect()->query($sql);
        // return $result;

        try {
            $sql = "INSERT INTO $this->table (";
            foreach ($data as $key => $value) {
                $sql .= "$key, ";
            }
            // INSERT INTO $this->table (name, description, status, 
            $sql = rtrim($sql, ", ");
            // INSERT INTO $this->table (name, description, status
            $sql .= " ) VALUES (";
            // INSERT INTO $this->table (name, description, status) VALUES (
            foreach ($data as $key => $value) {
                $sql .= "'$value', ";
            }

            // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1', 
            $sql = rtrim($sql, ", ");
            // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1'

            $sql .= ")";
            // INSERT INTO $this->table (name, description, status) VALUES ('category test', 'category test description', '1')

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $conn->insert_id;
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm dữ liệu: ' . $th->getMessage());
            return false;
        }
    }

    public function Statistical_order($subdays)
    {
        $result = [];
        try {
            // Truy vấn SQL: sử dụng INTERVAL để tính toán ngày bắt đầu từ số ngày được truyền vào ($subdays)
            $sql = "SELECT \n"

                . "    DATE(date) AS order_day,\n"

                . "    COUNT(*) AS total_orders,  \n"

                . "    SUM(total) AS total_value \n"

                . "FROM \n"

                . "    orders\n"

                . "WHERE \n"

                . "    date >= DATE_SUB(CURRENT_DATE, INTERVAL ' $subdays' DAY)  -- Lọc các đơn hàng trong 7 ngày qua\n"

                . "    AND date < CURRENT_DATE  -- Không bao gồm ngày hôm nay\n"

                . "GROUP BY \n"

                . "    DATE(date)  -- Nhóm theo ngày\n"

                . "ORDER BY \n"

                . "    order_day;";

            // Thực thi truy vấn và lấy kết quả
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAllorder_admin($number)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table WHERE transport = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $number);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getAllOrderbyUser_idByTransport()
    {
        $result = [];
        try {
            $sql = "SELECT orders.id, orders.total, orders.orderStatus, orders.date, orders.paymentMethod, orders.transport, orders.user_id 
                    FROM orders WHERE orders.user_id = " . $_SESSION['user']['id'] . " AND orders.transport = 1";

            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getAllOrderbyUser_idByCanceled()
    {
        $result = [];
        try {
            $sql = "SELECT orders.id, orders.total, orders.orderStatus, orders.date, orders.paymentMethod, orders.transport, orders.user_id 
                    FROM orders WHERE orders.user_id = " . $_SESSION['user']['id'] . " AND orders.transport = 4";

            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function transport(int $id)
    {


        try {
            $sql = "UPDATE `orders` SET transport = 2, orderStatus = 2 WHERE id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('i', $id);
            return $stmt->execute();
        } catch (\Exception $e) {
            return $e->getCode();
        }
    }

    public function updateTransportByUserId(int $id)
{
    $result = [];
    try {
        $sql = "UPDATE $this->table SET transport = 2 WHERE user_id = $id AND paymentMethod = 'VNPAY' AND transport = 0";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param('i', $id); // 's' vì $id là string
        $stmt->execute();

    } catch (\Throwable $th) {
        error_log('Lỗi khi cập nhật dữ liệu: ' . $th->getMessage());
        return ['success' => false, 'message' => 'An error occurred'];
    }
}

    
    public function getAllOrderbyUser_idBY($id)
    {
        $result = [];
        try {
            // Câu SQL với tham số ràng buộc
            $sql = "SELECT * FROM orders WHERE user_id = ? AND ";

            // Kết nối cơ sở dữ liệu
            $conn = $this->_conn->MySQLi();


            // Chuẩn bị câu lệnh
            $stmt = $conn->prepare($sql);


            // Gắn tham số
            $stmt->bind_param('i', $id);

            // Thực thi câu lệnh


            // Lấy kết quả
            $result = $stmt->get_result();
            $orders = $result->fetch_all(MYSQLI_ASSOC);

            // Đóng câu lệnh
            $stmt->close();

            return $orders; // Trả về danh sách đơn hàng
        } catch (\Throwable $th) {
            // Ghi log lỗi
            error_log('Lỗi khi lấy danh sách đơn hàng: ' . $th->getMessage());
            return $result; // Trả về mảng rỗng nếu có lỗi
        }
    }
    public function getOne_OrderByStatus($id)
    {

        $result = [];
        try {
            $sql = "SELECT id, transport FROM orders WHERE id=?";
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
}
