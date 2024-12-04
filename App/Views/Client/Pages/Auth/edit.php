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



        <?php

    }
}
