<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class VourcherValidation
{

    public static function create()
    {
        $is_valid = true;


        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Không để trống tên');
            $is_valid = false;
        }

        if (!isset($_POST['unit']) || $_POST['unit'] === '') {
            NotificationHelper::error('unit', 'Không để trống giá trị');
            $is_valid = false;
        }

        if (!isset($_POST['date_start']) || $_POST['date_start'] === '') {
            NotificationHelper::error('date_start', 'Không để trống ngày bắt đầu');
            $is_valid = false;
        }
        if (!isset($_POST['date_end']) || $_POST['date_end'] === '') {
            NotificationHelper::error('date_end', 'Không để trống ngày kết thúc');
            $is_valid = false;
        } else if (!empty($_POST['date_start']) && strtotime($_POST['date_end']) <= strtotime($_POST['date_start'])) {
            NotificationHelper::error('date_end_date_start', 'Ngày kết thúc phải lớn hơn ngày bắt đầu');
            $is_valid = false;
        }



        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Không để trống trạng thái');
            $is_valid = false;
        }

        return $is_valid;
    }

    public static function edit()
    {
        $is_valid = true;

        // Tên đăng nhập
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Không để trống tên');
            $is_valid = false;
        }

        // Mật khẩu
        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Không để trống trạng thái');
            // var_dump($_POST['status']);
            $is_valid = false;
        }

        if (!isset($_POST['unit']) || $_POST['unit'] === '') {
            NotificationHelper::error('unit', 'Không để trống giá trị');
            $is_valid = false;
        }

        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Không để trống trạng thái');
            $is_valid = false;
        }

        if (!isset($_POST['date_start']) || $_POST['date_start'] === '') {
            NotificationHelper::error('date_start', 'Không để trống ngày bắt đầu');
            $is_valid = false;
        }
        if (!isset($_POST['date_end']) || $_POST['date_end'] === '') {
            NotificationHelper::error('date_end', 'Không để trống ngày kết thúc');
            $is_valid = false;
        } else if (!empty($_POST['date_start']) && strtotime($_POST['date_end']) <= strtotime($_POST['date_start'])) {
            NotificationHelper::error('date_end_date_start', 'Ngày kết thúc phải lớn hơn ngày bắt đầu');
            $is_valid = false;
        }


        return $is_valid;
    }
}
