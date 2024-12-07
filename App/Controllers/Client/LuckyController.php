<?php

namespace App\Controllers\Client;

use App\Models\Lucky;
use App\Models\User;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Lucky_spin\Luky_spin;
use App\Helpers\NotificationHelper;

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

        $userModel = new User();
        $user = $userModel->getUserId($userId);
        $turnsLeft = $user['turns'];
        if ($turnsLeft > 0) {
            $randomIndex = array_rand($prizes);
            $prize = $prizes[$randomIndex];
            $prizeName = $prize['name'];
            $prizeAngle = $prize['angle'];
            $unit = $prize['unit'];

            $this->model->saveResult($userId, $prizeName, $unit);
            $this->model->updateTurns($userId, $turnsLeft - 1);

            echo json_encode([
                'prize' => $prizeName,
                'angle' => $prizeAngle,
                'unit' => $unit,
            ]);
        }
        
        
       
    }


    public static function points()
    {
        $pointsInput = $_POST['points'];
        $turns  = $_POST['turns'];

        $user_id = $_SESSION['user']['id'];
        $userModel = new User();
        $user = $userModel->getUserId($user_id);
       
        $pointsUser = $user['accumulate_points'];

        $points = $pointsUser - $pointsInput; 

       $user = new User();
       $result = $user->updateUserPoints($user_id, $points, $turns);

       if ($result){
        NotificationHelper::success('points', 'Quy đổi điểm thành công');
      
       }
       else{
        NotificationHelper::error('points', 'Quy điểm điểm thất bại');
      
       }
       header('Location: /users/' . $user_id);
       exit;
      

    }

    public static function oneUser(){
        $user_id = $_SESSION['user']['id'];
        $userModel = new User();
        $user = $userModel->getUserId($user_id);
        return $user;
    }
   
    

}

