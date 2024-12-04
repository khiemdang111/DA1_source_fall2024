<?php

namespace App\Models;

use App\Helpers\NotificationHelper;

class Lucky extends BaseModel
{
    protected $table = 'discount_codes';
    protected $id = 'id';

    public function saveResult($userId, $name, $unit)
    {
        try {
            // header("Content-Type: application/json; charset=UTF-8");
            // $sql = "INSERT INTO discount_codes (user_Id, name, unit) VALUES (:user_id, :name, :unit)";
            // $conn = $this->_conn->MySQLi();
            // $stmt = $conn->prepare($sql);
            // $stmt->execute(params: [
            //     ':user_id' => $userId,
            //     ':name' => $name,
            //     ':prize' => $unit,
            // ]);
            // return true;
            header("Content-Type: application/json; charset=UTF-8");
            if (empty($unit)) {
                $unit = 0;  // Hoặc bạn có thể thay bằng NULL nếu cột cho phép giá trị NULL
            }
            $sql = "INSERT INTO discount_codes (user_Id, name, unit) VALUES (?, ?, ?)";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $userId, $name, $unit);
            $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi lưu kết quả vòng quay: ' . $th->getMessage());
            return false;
        }
    }

    // Lấy danh sách các giải thưởng
    public function getPrizes()
    {
        return [
            ['name' => 'Giảm giá 10k', 'angle' => 90, 'unit' => '10000'],
            ['name' => 'Giảm giá 50k', 'angle' => 180, 'unit' => '50000'],
            ['name' => 'Giảm giá 100k', 'angle' => 270, 'unit' => '100000'],
            ['name' => 'Chúc bạn may mắn lần sau', 'angle' => 360, 'unit' => ''],
        ];
    }


    public function updateTurns($userId, $newTurns)
{
    $sql = "UPDATE users SET turns = ? WHERE id = ?";
    $conn = $this->_conn->MySQLi();
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $newTurns, $userId); 
    return $stmt->execute();
}



}