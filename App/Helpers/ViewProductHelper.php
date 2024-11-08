<?php

namespace App\Helpers;

use App\Models\Product;

class ViewProductHelper
{

    public static function cookieView($id, $view)
    {
        if (isset($_COOKIE['view'])) {
            $view_data = json_decode($_COOKIE['view'], true);
        } else {
            $view_data = [];
        }
        $id_arr = array_column($view_data, 'product_id');
        // echo  '<pre>';
        // var_dump($view_data);
        // var_dump($id_arr);

        // kiểm tra id có tồn tại trong cookie view hay chưa
        if (in_array($id, $id_arr)) {
            foreach ($view_data as $key => $value) {
                if ($view_data[$key]['product_id'] == $id) {
                    if ($view_data[$key]['time'] == time() - 60 * 5) {
                        $view++;
                    }
                    $view_data[$key]['time'] = time();
                }
            }
        }else{
            // nếu chưa có thì thêm vào cookie view
            $product_array = [
                'product_id' => $id,
                'time'  => time(),
            ];
            $view++;
            $view_data[] = $product_array;
        }
        // chuyển array thành string để lưu vào cookie view
        $product_data = json_encode($view_data);

        // lưu cookie
        setcookie('view', $product_data, time() + 3600 * 24 * 30, '/');
        return self::updateView($id,$view);    
    }


    public static function updateView($id,$view){
    $product = new Product();
    $data = [
      'view' => $view
    ];

    $result = $product->updateProduct($id,$data);
   return $result;
    }
}
