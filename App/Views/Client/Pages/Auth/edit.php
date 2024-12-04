<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;
use App\Views\Client\Components\NavbarAccount;
use App\Views\Client\Components\Notification;

class edit extends BaseView
{
    public static function render($data = null)
    {

        // var_dump($data['avatar']);
?>

        <div class="container">
            <div class="row p-5">
                <div class="col-md-4">
                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Thông tin cá nhân </h3>
                            <?php
                            NavbarAccount::render($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card ">
                        <h4 class="text-center title_color">Thông tin tài khoản</h4>
                        <p class="text-right text-danger mr-2">Điểm thưởng: <?= $data['accumulate_points'] ?></p>
                        <p class="text-right text-danger mr-2">Số lượt quay: <?= $data['turns'] ?></p>

                    
                        <form class="p-2" action="/users/update/<?= $data['id'] ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="method" value="PUT">
                            <?php
                            if ($data && $data['avatar']):
                            ?>
                                <div class="text-center "> <img class="avatar_user"
                                        src="<?= APP_URL ?>/public/uploads/users/<?= $data['avatar'] ?>" alt="" width="10%">
                                </div>

                            <?php
                            else:
                            ?>
                                <div class="text-center "> <img class="avatar_user"
                                        src="<?= APP_URL ?>/public/uploads/users/user.png" alt="" width="10%">
                                </div>
                            <?php
                            endif; ?>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên đăng nhập</label>
                                <input value="<?= $data['username'] ?>" name="username" type="text" class="form-control"
                                    id="exampleInputEmail1" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                                <input value="<?= $data['phone'] ?>" name="phone" type="text" class="form-control"
                                    id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input value="<?= $data['email'] ?>" name="email" type="email" class="form-control"
                                    id="exampleInputEmail1">

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Ảnh đại diện</label>
                                <input name="avatar" type="file" class="form-control" id="exampleInputPassword1">
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" id="body-span-lucky">
                    <input type="hidden" name="method">
                    <div class="bodylucky">
                        <div class="mainboxlucky" id="mainboxlucky">
                            <div class="arrow"></div>
                            <div class="box" id="box">
                                <div class="box1">
                                    <span class="font span1"><b>Giảm giá 10k</b></span>
                                    <span class="font span2"><b>Giảm giá 100K</b></span>
                                </div>
                                <div class="box2">
                                    <span class="font span3"><b>Giảm giá 50K</b></span>
                                    <span class="font span4"><b>Chúc bạn may mắn lần sau</b></span>
                                </div>
                            </div>
                            <button class="spin" id="spinButton" onclick="spin()">Quay</button>
                        </div>
                    </div>
                </div>
                <audio controls="controls" id="applause" src="<?= APP_URL ?>/public/uploads/void/applause.mp3"
                    type="audio/mp3"></audio>
                <audio controls="controls" id="wheel" src="<?= APP_URL ?>/public/uploads/void/nhacxoso.mp3"
                    type="audio/mp3"></audio>

            </div>
        </div>

        <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">


                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Đổi điểm quay voucher</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/points" method="post" id="exchangeForm">
                        <input type="hidden" name="method" value="POST">
                        <div class="modal-body">
                            <h6 class="text-danger">Điểm hiện tại của bạn: <?= $data['accumulate_points'] ?></h6>
                            <div class="form-group">
                                <label for="points">Nhập số điểm bạn muốn đổi:</label>
                                <input type="number" class="form-control" id="points" name="points" min="100" step="100" max=" <?= $data['accumulate_points'] ?>"
                                    placeholder="Nhập số điểm (tối thiểu 100)" required>
                            </div>
                            <div class="form-group">
                                <label for="turns">Số lượt quay nhận được:</label>
                                <input type="text" class="form-control" id="turns" name="turns" readonly>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const currentPoints = <?= $data['accumulate_points'] ?>;
            const maxPoints = Math.floor(currentPoints / 100) * 100;

            document.getElementById('points').addEventListener('input', function() {
                let pointsInput = parseInt(this.value) || 0;
                if (pointsInput > maxPoints) {
                    pointsInput = maxPoints;
                }
                this.value = pointsInput;
                const turns = Math.floor(pointsInput / 100);
                document.getElementById('turns').value = turns > 0 ? turns : 0;
            });
        </script>


<?php

    }
}
