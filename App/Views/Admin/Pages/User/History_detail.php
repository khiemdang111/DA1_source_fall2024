<?php
namespace App\Views\Admin\Pages\User;

use App\Views\BaseView;

class History_detail extends BaseView
{
    public static function render($data = null)
    {
       
        //   echo '<pre>';
//            var_dump($data[0]['name']);
//            die;
        ?>
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-3">
                <h5 class="card-header">Danh sách thanh toán</h5>
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Danh sách thanh toán</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <form action="/admin/users/search" method="get">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                            <input type="text" class="form-control" name="keywords" placeholder="Tìm kiếm"
                                value="<?= (isset($_SESSION['keywords']) ? $_SESSION['keywords'] : "") ?>" aria-label="Tìm kiếm"
                                aria-describedby="basic-addon-search31" />
                        </div>

                    </form>
                </div>
               
                    <div class="table-responsive text-nowrap">
                        <?php
                        if (count($data)):
                            $data_adress = $data[0]['address'] . " " . $data[0]['ward'] . " " . $data[0]['district'] . " " . $data[0]['province'];

                            ?>
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Người nhận </th>
                                        <th>Địa chỉ giao </th>
                                        <th>Số điện thoại </th>
                                        <th>Phương thức thanh toán </th>
                                        <th>Thời gian đặt hàng</th>


                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">

                                    <tr>
                                        <td>
                                            <?= $data[0]['name'] ?>
                                        </td>
                                        <td>
                                            <?= $data_adress ?>
                                        </td>
                                        <td> <?= $data[0]['phone'] ?></td>
                                        <td> <?= ($data[0]['paymentMethod'] === "COD") ? ' Thanh toán khi nhận hàng ' : ' VNPAY' ?></td>

                                        <td> <?= $data[0]['date'] ?></td>



                                    </tr>
                                </tbody>
                            </table>

                            <?php
                        else:

                            ?>
                            <h4 class="text-center text-danger">Không có dữ liệu</h4>
                            <?php
                        endif;

                        ?>


                    </div>
                    <div class="table-responsive text-nowrap my-4">
                        <?php
                        if (count($data)):
                            ?>
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 15px">Id</th>
                                        <th>Tên</th>
                                        <th>Hình ảnh</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>

                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php
                                    foreach ($data as $item):
                                        ?>
                                        <tr>
                                            <td><?= $item['product_id'] ?></td>
                                            <td><?= $item['product_name'] ?></td>
                                            <td><img src="<?= APP_URL ?>/public/uploads/products/<?= $item['product_image'] ?>" alt=""
                                                    width="100px"></td>
                                            <td>

                                                <?php
                                                if ($item['originalPrice'] > 0):
                                                    ?>
                                                    <div class="item">
                                                        <?= number_format($item['unitPrice']) ?> VND
                                                    </div>
                                                    <?php
                                                else:
                                                    ?>
                                                    <div class="item"><?= number_format($item['unitPrice']) ?> VND</div>
                                                    <?php
                                                endif;
                                                ?>
                                            </td>
                                            <td><?= $item['quantity'] ?></td>
                                        </tr>
                                        <?php
                                    endforeach;


                                    ?>
                                </tbody>
                            </table>

                            <?php
                        else:

                            ?>
                           
                            <?php
                        endif;

                        ?>


                    </div>
               
                



            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <?php
    }
}
