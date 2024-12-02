<?php

namespace App\Controllers\Client;

use App\Models\Lucky;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Lucky_spin\Luky_spin;

class LuckyController
{
    
    private $model;

    public function __construct()
    {
        $this->model = new Lucky();
    }

    // Hiển thị giao diện vòng quay
    public function index()
    {
        $prizes = $this->model->getPrizes();
        include_once '../views/lucky_wheel.php'; // Kết nối với view 
    }

    // Xử lý khi quay
    public function spin()
    {
        header("Content-Type: application/json; charset=UTF-8");
        
        $userId = $_SESSION['user']['id']; // Lấy ID người dùng từ session
        $prizes = $this->model->getPrizes();
        // Random một giải thưởng
        $randomIndex = array_rand($prizes);
        $prize = $prizes[$randomIndex]; 
        $prizeName = $prize['name'];
        $prizeAngle = $prize['angle'];
        $unit = $prize['unit']; 
        
        // Lưu kết quả quay vào cơ sở dữ liệu
        
        $this->model->saveResult($userId, $prizeName, $unit);
       
        // Trả về kết quả cho client
        echo json_encode([
            'prize' => $prizeName,
            'angle' => $prizeAngle,
            'unit' => $unit, 
        ]);       
    }

}

