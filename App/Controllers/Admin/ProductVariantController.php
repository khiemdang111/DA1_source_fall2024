<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Validations\ProductValidation;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\ProductVariant\SettingVariant;
use App\Views\Admin\Pages\ProductVariant\SettingPriceVariant;
use App\Views\Admin\Pages\ProductVariant\DetailSettingVariant;
use App\Views\Admin\Pages\ProductVariant\createAttributeVariant;
use App\Views\Admin\Pages\ProductVariant\EditAttributeVariant;

class ProductVariantController
{

    public static function createVariant($id)
    {
        // validation các trường dữ liệu
        $products = new product();
        $product = $products->getOneProductByCategoryDetailStatus($id);
        $variants = new ProductVariant();
        $variant = $variants->getAllProductByVariant();
        $variant_opt = $variants->getAllVariantOptionsById($id);
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

        $produtc = new ProductVariant();
        $result = $produtc->createProductVariant($combinedOptions);
    }

    public function createAttributeVariant()
    {
        $product = new ProductVariant();
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
        $product = new ProductVariant();
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
    public function settingVariant()
    {
        $id = $_SESSION['id'];
        unset($_SESSION['id']);
        $products = new ProductVariant();
        $data = $products->SettingVariantByProductId($id);
        Header::render();
        // hiển thị form thêm
        Notification::render();
        NotificationHelper::unset();
        SettingPriceVariant::render($data);
        Footer::render();
    }
    public function settingDetailVariant($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productName = $_POST['product_name'];
            $variants = explode(',', $_POST['variants']);
            $variant_ids = explode(',', $_POST['variant_ids']);
        }

        $productID = $_SESSION['product_id'];
        $products = new ProductVariant();
        $variant_value_id = $products->SelectProductVariantValueID($productID, $variants, $variant_ids);

        // Gọi InsertCombinationID và nhận giá trị combination_id

        $combination_id = $products->InsertCombinationID($variant_value_id);
        // Kiểm tra nếu thành công, gán vào session
        if ($combination_id) {
            $combination_id = $_SESSION['id_combination'];
            header('Location: /admin/createdetail/variant/' . $combination_id);
            exit();
        } else {
            echo "Insert combination ID thất bại.";
        }
    }
    public function detailSettingVariant($id)
    {

        $product = new ProductVariant();
        $id = $_SESSION['id_combination'];
        $data = $product->DetailVariant($id);
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        DetailSettingVariant::render($data);
        Footer::render();
    }

    public function addSku()
    {
        $is_valid = ProductValidation::createSku();
        if (!$is_valid) {
            NotificationHelper::error('store_product', 'Thêm sản phẩm thất bại');
            header('location: /admin/products');
            exit;
        }
        $name = $_POST['name'];
        $sku = $_POST['sku'];
        $product_id = $_POST['product_id'];
        $description = $_POST['description'];
        // Kiểm tra các tên có tồn tại hay chưa
        $product = new ProductVariant();

        $data = [
            'name' => $name,
            'price' => $_POST['price'],
            'description' => $description,
            'product_id' => $product_id,
            'sku' => $sku,
        ];

        $is_upload = ProductValidation::updateImage();
        //  var_dump($is_upload);
        if ($is_upload) {
            $data['image'] = $is_upload;
        }

        $result = $product->createSku($data);
        if ($result) {
            $combination_id = $_SESSION['id_combination'];
            $sku_id = $_SESSION['sku_id'];
            $addFkSku = $product->addFkSku($combination_id, $sku_id);
            unset($_SESSION['id_combination']);
            unset($_SESSION['sku_id']);
            header('Location: /admin/products');
        } else {
            NotificationHelper::error('create_product', 'Thêm sản phẩm thất bại');
            header('Location: /admin/productvariant/setting');
            exit;
        }
    }
    public function editAttributeVariant($id)
    {
        $product = new ProductVariant();
        $variant = $product->getAllAttribute($id);
        $option_name = $product->getAllAttributeAndOptionName($id);
        $data = [
            'variant' => $variant,
            'option_name' => $option_name,
        ];
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        EditAttributeVariant::render($data);
        Footer::render();
    }
    public function updateVariantAttribute($id)
    {
        $data = [
            'id' => $_POST['variant_id'],
            'name' => $_POST['variant_name'],
        ];
        $table = $_POST['table'];
        $productvariant = new ProductVariant();
        $result = $productvariant->updateAttribute($data, $table);
        if ($result) {
            NotificationHelper::success('success_add_attribute', 'Cập nhật thành công');
            header('Location: /admin/variant/add');
        } else {
            NotificationHelper::error('error_add_attribute', 'Cập nhật thất bại!');
            header("Location: /admin/variant/add");
        }
    }
    public function delVariantAttribute($id)
    {
        $data = [
            'id' => $_POST['variant_id'],
            'status' => 0,
        ];
        $table = $_POST['table'];
        $productvariant = new ProductVariant();
        $result = $productvariant->delAttribute($data, $table);
        if ($result) {
            NotificationHelper::success('success_add_attribute', 'Cập nhật thành công');
            header('Location: /admin/variant/add');
        } else {
            NotificationHelper::error('error_add_attribute', 'Cập nhật thất bại!');
            header("Location: /admin/variant/add");
        }
    }
}
