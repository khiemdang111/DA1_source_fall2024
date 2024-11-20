<?php

namespace App\Models;

use App\Helpers\NotificationHelper;

class vnpays extends BaseModel
{
    protected $table = 'vnpays';
    protected $id = 'id';

    public function createVnpay($data)
    {
        return $this->create($data);
    }
}