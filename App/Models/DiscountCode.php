<?php

namespace App\Models;


class DiscountCode extends BaseModel
{
    protected $table = 'discount_codes';
    protected $id = 'id';

    public function getdiscountCode($voucher_code)
    {
        try {
            $sql = "SELECT * FROM discount_codes WHERE name = ?  ";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param('s', $voucher_code);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } catch (\Throwable $th) {
            error_log('Lỗi khi truy vấn mã giảm giá: ' . $th->getMessage());
            return null; // Trả về null nếu có lỗi
        }
    }
    public function getDiscountCodeByUser($user_id)
    {
        try {
            // Câu truy vấn SQL
            $sql = "SELECT * FROM discount_codes WHERE user_id = ?";

            // Kết nối đến cơ sở dữ liệu
            $conn = $this->_conn->MySQLi();

            // Chuẩn bị câu lệnh
            $stmt = $conn->prepare($sql);



            // Gán tham số
            $stmt->bind_param('i', $user_id);

            // Thực thi câu lệnh
            $stmt->execute();

            // Lấy kết quả
            $result = $stmt->get_result();

            // Kiểm tra và trả về kết quả dưới dạng mảng
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            // Đóng tài nguyên
            $stmt->close();
            $conn->close();

            return $data; // Trả về dữ liệu
        } catch (\Throwable $th) {
            // Ghi log lỗi
            error_log('Lỗi khi truy vấn mã giảm giá: ' . $th->getMessage());
            return null; // Trả về null nếu có lỗi
        }
    }
}
