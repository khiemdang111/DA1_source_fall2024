<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Product;
use App\Models\Category;
use App\Validations\ProductValidation;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Product\Create;
use App\Views\Admin\Pages\Product\Edit;
use App\Views\Admin\Pages\Product\Index;
use App\Views\Admin\Pages\Product\SettingVariant;
use App\Views\Admin\Pages\Product\SettingPriceVariant;
use App\Views\Admin\Pages\Product\DetailSettingVariant;
use App\Views\Admin\Pages\Product\createAttributeVariant;
use App\Views\Admin\Pages\Recycle\ProductRecycle;

class ProductController
{


    // hiển thị danh sách
    public static function index()
    {

        $product = new Product();
        $data = $product->getAllProductByStatus();
        Header::render();
        Notification::render();
        //hủy thông báo
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }


    // hiển thị giao diện form thêm
    public static function create()
    {

        // $product = new Product();
        $category = new Category();
        $categories = $category->getAllCategory();
        $variant = new Product;
        $variant_data = $variant->getAllProductByVariant();
        // var_dump($data);
        // $data = $product->getAllProduct();
        // var_dump($_SESSION);
        $data = [
            'categories' => $categories,
            'variant_data' => $variant_data,
        ];

        Header::render();
        // hiển thị form thêm
        Notification::render();
        NotificationHelper::unset();
        Create::render($data);
        Footer::render();
    }


    // // // xử lý chức năng thêm
    public static function store()
    {
        // validation các trường dữ liệu
        $is_valid = ProductValidation::create();

        if (!$is_valid) {
            NotificationHelper::error('store_product', 'Thêm sản phẩm thất bại');
            header('location: /admin/products/create');
            exit;
        }
        $name = $_POST['name'];
        $tatus = $_POST['status'];
        // Kiểm tra các tên có tồn tại hay chưa
        $product = new Product();
        $is_exist = $product->getOneProductByName($name);

        if ($is_exist) {
            NotificationHelper::error('store_product2', 'Tên sản phẩm này đã tồn tại');
            header('location: /admin/products/create');
            exit;
        }
       
       
        // Thêm vào
        $data = [
            'name' => $name,
            'price' => $_POST['price'],
            'discount_price' => $_POST['discount_price'],
            'description' => $_POST['description'],
            'is_featured' => $_POST['is_featured'],
            'status' => $_POST['status'],
            'category_id' => $_POST['category_id'],
        ];
        $result = $product->createProduct($data);

        if ($result) {
            NotificationHelper::success('create_product', 'Thêm sản phẩm thành công');
            header('location: /admin/products');
        } else {
            NotificationHelper::error('create_product', 'Thêm sản phẩm thất bại');
            header('location: /admin/products/create');
            exit;
        }
    }


    public static function edit(int $id)
    {

        $product = new product();
        $data_product = $product->getOneproduct($id);
        $category = new category();
        $data_category = $category->getAllCategory();
        if (!$data_product) {
            NotificationHelper::error('edit_product', 'Không thể xem sản phẩm này!');
            header('Location: /admin/products');
        }
        $data = [
            'product' => $data_product,
            'category' => $data_category,

        ];
        //    echo '<pre>';
        //    var_dump($data['product']['name']);
        Header::render();
        Notification::render();
        //hủy thông báo
        NotificationHelper::unset();
        // hiển thị form sửa
        Edit::render($data);
        Footer::render();
    }


    public static function update(int $id)
    {

        $is_valid = ProductValidation::edit();
        if (!$is_valid) {
            NotificationHelper::error('update_product2', 'Cập nhật sản phẩm thất bại  !');
            header("Location: /admin/products/$id");
            exit();
        }
        $name = $_POST['name'];

        // kiểm tra product name đã tồn tại chgx nếu có thì thông báo ra 
        $product = new product();
        $is_exist = $product->getOneproductByName($name);

        if ($is_exist && $is_exist['id'] != $id) {
            NotificationHelper::error('update_product', 'Tên loại sản phẩm đã tồn tại!');
            header("Location: /admin/products/$id");
            exit();
        }
        $data = [
            'name' => $name,
            'price' => $_POST['price'],
            'discount_price' => $_POST['discount_price'],
            'description' => $_POST['description'],
            'category_id' => $_POST['category_id'],
            'is_featured' => $_POST['is_featured'],
            'status' => $_POST['status'],
        ];
        $is_upload = ProductValidation::updateImage();
        if ($is_upload) {
            $data['image'] = $is_upload;
        }
        $result = $product->updateproduct($id, $data);
        if ($result) {
            NotificationHelper::success('update_products', 'Cập nhật sản phẩm thành công!');
            header('Location: /admin/products');
        } else {
            NotificationHelper::error('update_products', 'Cập nhật sản phẩm thất bại!');
            header("Location: /admin/products/$id");
        }
    }



    public static function delete(int $id)
    {
        $product = new product();
        $is_exist = $product->getOneProduct($id);
        if ($is_exist && $is_exist['id'] === $id) {
            $data = [
                'status' => 0,
            ];
            $result = $product->updateproduct($id, $data);
        }
        if ($result) {
            NotificationHelper::success('delete_product', 'Xóa sản phẩm thành công!');
            header('Location: /admin/products');
        } else {
            NotificationHelper::error('delete_product', 'Xóa sản phẩm thất bại!');
            header("Location: /admin/products");
        }
    }

    public static function productRecycle()
    {
        $product = new Product();
        $data = $product->getAllProductByStatusRecycle();
        Header::render();
        Notification::render();
        //hủy thông báo
        NotificationHelper::unset();
        ProductRecycle::render($data);
        Footer::render();
    }

    public static function restore(int $id)
    {
        $product = new Product();
        $is_exist = $product->getOneProduct($id);
        if ($is_exist && $is_exist['id'] === $id) {
            $data = [
                'status' => 1,
            ];
            $result = $product->updateproduct($id, $data);
        }
        if ($result) {
            NotificationHelper::success('restore_product', 'Khôi phục sản phẩm thành công!');
            header('Location: /admin/recycle/products');
        } else {
            NotificationHelper::error('restore_product', 'Khôi phục sản phẩm thất bại!');
            header("Location: /admin/recycle/products");
        }
    }
    public static function deletePermanently(int $id)
    {
        $product = new Product();
        $is_exist = $product->getOneProduct($id);
        if ($is_exist && $is_exist['id'] === $id) {
            $data = [
                'status' => 2,
            ];
            $result = $product->updateproduct($id, $data);
        }
        if ($result) {
            NotificationHelper::success('deletePermanently_product', 'Xóa vĩnh viễn sản phẩm thành công!');
            header('Location: /admin/recycle/products');
        } else {
            NotificationHelper::error('deletePermanently_product', 'Xóa vĩnh viễn sản phẩm thất bại!');
            header("Location: /admin/recycle/products");
        }
    }
    public static function createVariant($id)
    {
        // validation các trường dữ liệu
        $products = new product();
        $product = $products->getOneProductByCategoryDetailStatus($id);
        $variant = $products->getAllProductByVariant();
        $variant_opt = $products->getAllVariantOptionsById($id);
        $data = [
            'product' => $product,
            'variant' => $variant,
            'variant_opt' => $variant_opt,
        ];
        // echo '<pre>';
        // var_dump($data['variant_opt']);
        // die;
        Header::render();
        Notification::render();
        //hủy thông báo
        NotificationHelper::unset();
        SettingVariant::render($data);
        Footer::render();
    }
    public static function storeVariant()
    {
        // validation các trường dữ liệu
        $is_valid = ProductValidation::createVariant();

        if (!$is_valid) {
            NotificationHelper::error('store_product', 'Thêm sản phẩm thất bại');
            header('location: /admin/products');
            exit;
        }

        // Lấy giá trị từ $_POST
        $option_values = $_POST['option_vl_name'] ?? [];
        $id_product = $_POST['id'];
        $option_ids = $_POST['option_vl_name'] ?? [];
        $pro_variant_ids = $_POST['pro_variant_id'] ?? [];
        // Tạo mảng kết hợp

        $combinedOptions = [];

        foreach ($option_ids as $index => $id) {
            if (isset($option_values[$index])) {
                // Lấy pro_variant_id từ mảng tương ứng
                $pro_variant_id = isset($pro_variant_ids[$index]) ? $pro_variant_ids[$index] : null;

                // Thêm phần tử vào mảng kết hợp
                $combinedOptions[] = [
                    'product_id' => $id_product,
                    'pro_variant_id' => $pro_variant_id,
                    'option_id' => $id,
                ];
            }
        }

        $produtc = new Product();
        $result = $produtc->createProductVariant($combinedOptions);
    }

    public function createAttributeVariant()
    {
        $product = new Product();
        $data = $product->getAllVariantAndAttribute();
        Header::render();
        // hiển thị form thêm
        Notification::render();
        NotificationHelper::unset();
        createAttributeVariant::render($data);
        Footer::render();
    }
    public static function storeAttribute()
    {
        // validation các trường dữ liệu
        $is_valid = ProductValidation::createAttribute();
        if (!$is_valid) {
            NotificationHelper::error('store_product', 'Thêm sản phẩm thất bại');
            header('location: /admin/products/create');
            exit;
        }

        $data = [
            'name' => $_POST['product_variant_name'],
            'value' => $_POST['product_variant_value'],
            'product_id' => $_POST['product_id'],
        ];
        $product = new Product();
        $result = $product->createNameVariant($data);
        $kq = $product->createValueVariant($data);
        if ($result && $kq) {
            NotificationHelper::success('create_product', 'Thêm sản phẩm thành công');
            header('location: /admin/variant/add');
        } else {
            NotificationHelper::error('create_product', 'Thêm sản phẩm thất bại');
            header('location: /admin/variant/add');
            exit;
        }
    }
    public function settingVariant(){
        $id = $_SESSION['id'];
        // var_dump($id);die;
        $products = new Product();
        $data = $products->SettingVariantByProductId($id);



        $product_id = $id;
        $variant_id = 1;  // Ví dụ xử lý cho variant_id = 1
        
        // Lọc dữ liệu có cùng product_id và variant_id
        $filteredData = array_filter($data, function($item) use ($product_id, $variant_id) {
            return $item['product_id'] == $product_id && $item['variant_id'] == $variant_id;
        });
        
        // Bước 2: Tạo các nhóm id_variant_value
        $groupedData = [];
        $groupId = 1;  // Tạo group_id bắt đầu từ 1
        
        // Lấy danh sách các id_variant_value
        $id_variant_values = [];
        foreach ($filteredData as $item) {
            $id_variant_values[] = $item['id_varaiant_value'];
        }
        
        // Hàm tạo tất cả các tổ hợp (combinations) của một mảng
        function getCombinations($array, $size) {
            $result = [];
            $count = count($array);
            if ($size == 1) {
                return array_map(function($item) { return [$item]; }, $array);
            }
            for ($i = 0; $i < $count; $i++) {
                $head = $array[$i];
                $tail = array_slice($array, $i + 1);
                $combinations = getCombinations($tail, $size - 1);
                foreach ($combinations as $combination) {
                    $result[] = array_merge([$head], $combination);
                }
            }
            return $result;
        }
        
        // Tạo tất cả các tổ hợp có thể với ít nhất 2 giá trị
        for ($size = 2; $size <= count($id_variant_values); $size++) {
            $combinations = getCombinations($id_variant_values, $size);
            
            // Gộp các tổ hợp vào nhóm
            foreach ($combinations as $combination) {
                $groupedData[] = [
                    'group_id' => $groupId++,  // Tăng group_id
                    'id_variant_values' => $combination,  // Lưu các giá trị trong nhóm
                ];
            }
        }      // Bây giờ $groupedData sẽ chứa tất cả các nhóm có nhiều hơn 2 id_variant_value
$combination_variant = $products->updateCombinatioValue($groupedData);

        Header::render();
        // hiển thị form thêm
        Notification::render();
        NotificationHelper::unset();
        SettingPriceVariant::render($data);
        Footer::render();
    }
    public function detailSettingVariant(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu JSON từ body của yêu cầu
            $input = file_get_contents('php://input');
            $decodedData = json_decode($input, true);
        
            // Gán dữ liệu vào biến $data
            $data = $decodedData['data'];
        
            // Xử lý dữ liệu (nếu cần)
            // ...
            var_dump($data);
            // Trả về phản hồi
            echo json_encode([
                'status' => 'success',
                'receivedData' => $data,
            ]);
        }
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        DetailSettingVariant::render();
        Footer::render();
    }
}
