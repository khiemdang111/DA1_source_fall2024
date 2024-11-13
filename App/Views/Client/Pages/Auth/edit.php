<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;
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
                            <ul class="menu_account">
                                <li>
                                    <a href=""><svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                            <path d="M3.433 17.325 3.079 19.8a1 1 0 0 0 1.131 1.131l2.475-.354C7.06 20.524 8 18 8 18s.472.405.665.466c.412.13.813-.274.948-.684L10 16.01s.577.292.786.335c.266.055.524-.109.707-.293a.988.988 0 0 0 .241-.391L12 14.01s.675.187.906.214c.263.03.519-.104.707-.293l1.138-1.137a5.502 5.502 0 0 0 5.581-1.338 5.507 5.507 0 0 0 0-7.778 5.507 5.507 0 0 0-7.778 0 5.5 5.5 0 0 0-1.338 5.581l-7.501 7.5a.994.994 0 0 0-.282.566zM18.504 5.506a2.919 2.919 0 0 1 0 4.122l-4.122-4.122a2.919 2.919 0 0 1 4.122 0z"></path>
                                        </svg>Đổi mật khẩu</a>
                                </li>
                                <li>
                                    <a href="#"><svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                            <path d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921z"></path>
                                            <circle cx="10.5" cy="19.5" r="1.5"></circle>
                                            <circle cx="17.5" cy="19.5" r="1.5"></circle>
                                        </svg>Lịch sử mua hàng </a>
                                </li>
                                <li>
                                    <a href="/logout"><svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                            <path d="M19.002 3h-14c-1.103 0-2 .897-2 2v4h2V5h14v14h-14v-4h-2v4c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.898-2-2-2z"></path>
                                            <path d="m11 16 5-4-5-4v3.001H3v2h8z"></path>
                                        </svg>Đăng xuất </a>
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card ">
                        <h4 class="text-center title_color">Thông tin tài khoản</h4>
                        <form class="p-2" action="/users/update/<?= $data['id'] ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="method" value="PUT">
                            <?php
                            if ($data && $data['avatar']) :
                            ?>
                                <div class="text-center "> <img class="avatar_user" src="<?= APP_URL ?>/public/uploads/users/<?= $data['avatar'] ?>" alt="" width="10%">
                                </div>

                            <?php
                            else :
                            ?>
                               <div class="text-center "> <img class="avatar_user" src="<?= APP_URL ?>/public/uploads/users/user.png" alt="" width="10%">
                               </div>
                            <?php
                            endif; ?>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên đăng nhập</label>
                                <input value="<?= $data['username'] ?>" name="username" type="text" class="form-control" id="exampleInputEmail1" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                                <input value="<?= $data['phone'] ?>" name="phone" type="text" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input value="<?= $data['email'] ?>" name="email" type="email" class="form-control" id="exampleInputEmail1" >

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Ảnh đại diện</label>
                                <input  name="avatar" type="file" class="form-control" id="exampleInputPassword1">
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>



        <!-- <div class="form_margin2">
            <div class="item_form_magin2">
                <?php
                if ($data && $data['avatar']) :
                ?>
                    <img src="<?= APP_URL ?>/public/uploads/img/<?= $data['avatar'] ?>" alt="" width="100%">

                <?php
                else :
                ?>
                    <img src="<?= APP_URL ?>/public/uploads/img/user.png" alt="">
                <?php
                endif; ?>

            </div>
            <div class="from_container2">
                <h3 class="title_h1">Thông tin tài khoản</h3>
                <form class="form_register" action="/users/<?= $data['id'] ?>" method="post" enctype="multipart/form-data">
                    <input value="" name ="" type="hidden" name="method" value="PUT">
                    <div class="md3">
                        <label class="label_input" for="username">Tên đăng nhập* :</label>
                        <input value="" name ="" name="username" class="input_register" type="text" placeholder="Mời bạn nhập tên tài khoản" value="<?= $data['username'] ?>" disabled />
                    </div>
                    <div class="md3">
                        <label class="label_input" for="phone">Số điện thoại* :</label>
                        <input value="" name ="" name="phone" class="input_register" type="text" placeholder="Mời bạn nhập số điện thoại" value="<?= $data['phone'] ?>" disabled />
                    </div>
                    <div class="md3">
                        <label class="label_input" for="email">Email*:</label>
                        <input value="" name ="" name="email" class="input_register" type="email" placeholder="Mời bạn nhập email" value="<?= $data['email'] ?>" />
                    </div>
                    <div class="md3">
                        <label class="label_input" for="email">Name*:</label>
                        <input value="" name ="" name="name" class="input_register" type="text" placeholder="Mời bạn nhập email" value="<?= $data['name'] ?>" />
                    </div>
                    <div class="md3">
                        <label class="label_input" for="">Ảnh đại diện (Avatar):</label>
                        <input value="" name ="" name="avatar" class="upload" type="file" />
                    </div>
                    <div class="md3">
                  <label class="label_input" for="password">Mật khẩu* :</label>
                  <input value="" name ="" name="password" class="input_register" type="password" />
              </div>
              <div class="md3">
                  <label class="label_input" for="re_password">Nhập lại mật khẩu* :</label>
                  <input value="" name ="" name="re_password" class="input_register" type="password" />
              </div> -->
        <!-- <input value="" name ="" class="btn btn-4 dk" value="Cập nhật" type="submit"></input>
                </form>
            </div>
        </div> -->

<?php

    }
}
