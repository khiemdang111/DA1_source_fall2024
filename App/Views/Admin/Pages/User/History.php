<?php

namespace App\Views\Admin\Pages\User;

use App\Views\BaseView;

class History extends BaseView
{
    public static function render($data = null)
    {
         
        ?>
       

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-3">
                <h5 class="card-header">Danh sách thanh toán</h5>
                <div class="card-body">
                    <!-- Basic Breadcrumb -->
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

            <!-- Basic Bootstrap Table -->
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
                <div class="card-header">
                    <select class="form-select select_status" id="select">
                        <option selected value="all">Tất cả đơn hàng</option>
                        <option value="1">Đang giao</option>
                        <option value="2">Giao thành công</option>
                        <option value="3">Hoàn tiền thành công</option>
                        <option value="0">Đã hủy</option>
                    </select>
                </div>
                <div class="table-responsive text-nowrap">
                    <?php
                    if (count($data)):
                        ?>
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Mã đơn hàng </th>
                                    <th>Số tiền thanh toán</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Ngày Mua</th>
                                    <th>Trạng thái</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="order-list">
                                <?php

                                foreach ($data as $item):
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $item['id'] ?>
                                        </td>
                                        <td>
                                            <?= number_format($item['total']) ?> VND
                                        </td>
                                        <td>
                                            <?= ($item['paymentMethod'] === "COD") ? ' Thanh toán khi nhận hàng ' : ' VNPAY' ?>
                                        </td>
                                        <td>
                                            <?= $item['date'] ?>
                                        </td>
                                        <td>
                                           <?php
                                           if($item['transport'] === 1){
                                            echo 'Đang giao';
                                           }else if($item['transport'] === 2){
                                             echo 'Giao thành công';
                                           }else if($item['transport'] === 3){
                                             echo 'Hoàn tiền thành công';
                                           }else{
                                             echo 'Đã hủy';
                                        }
                                           ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown">
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="/admin/users/history/detail/<?= $item['id'] ?>"><i
                                                                class='bx bxs-cart'></i></i> Chi tiết Thanh toán</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php
                                endforeach;
                                ?>
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
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#select').change(function () {
                     
                    var selectedValue = $(this).val()
                 
                    
                    if (selectedValue) {
                        $.ajax({
                            url: '/handleOrderStatus', 
                            method: 'POST', 
                            data: { status: selectedValue, method: 'POST', }, // Gửi trạng thái qua body của request
                            success: function (response) {
                                console.log(response);
                                
                                // Render dữ liệu trả về vào phần danh sách
                                $('#order-list').html(response);
                            },
                            error: function (xhr, status, error) {
                                console.error('Error:', xhr.responseText);
                                alert('Có lỗi xảy ra khi lọc trạng thái đơn hàng!');
                            }
                        });
                    }
                });
            });
        </script>




        <?php
    }
}
