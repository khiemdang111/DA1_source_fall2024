<?php

namespace App\Views\Client\Components;

use App\Models\Category as ModelsCategory;
use App\Views\BaseView;

class NavbarAccount extends BaseView
{
    public static function render($data = null)
    {
        ?>

        <ul class="menu_account">
            <li>
                <a href="/users/<?= $_SESSION['user']['id'] ?>"><svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                        <path
                            d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z">
                        </path>
                    </svg>Thông tin tài khoản</a>
            </li>
            <!-- <li>
                <a href=""><svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                        <path
                            d="M3.433 17.325 3.079 19.8a1 1 0 0 0 1.131 1.131l2.475-.354C7.06 20.524 8 18 8 18s.472.405.665.466c.412.13.813-.274.948-.684L10 16.01s.577.292.786.335c.266.055.524-.109.707-.293a.988.988 0 0 0 .241-.391L12 14.01s.675.187.906.214c.263.03.519-.104.707-.293l1.138-1.137a5.502 5.502 0 0 0 5.581-1.338 5.507 5.507 0 0 0 0-7.778 5.507 5.507 0 0 0-7.778 0 5.5 5.5 0 0 0-1.338 5.581l-7.501 7.5a.994.994 0 0 0-.282.566zM18.504 5.506a2.919 2.919 0 0 1 0 4.122l-4.122-4.122a2.919 2.919 0 0 1 4.122 0z">
                        </path>
                    </svg>Đổi mật khẩu</a>
            </li> -->
            <li>
                <a href="/history"><svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                  <path
                    d="M21 4H3a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-1 11a3 3 0 0 0-3 3H7a3 3 0 0 0-3-3V9a3 3 0 0 0 3-3h10a3 3 0 0 0 3 3v6z">
                  </path>
                  <path
                    d="M12 8c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z">
                  </path>
                </svg>Lịch sử thanh toán </a>
            </li>
            <li>
                <a href="/logout"><svg class="mx-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                        <path
                            d="M19.002 3h-14c-1.103 0-2 .897-2 2v4h2V5h14v14h-14v-4h-2v4c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.898-2-2-2z">
                        </path>
                        <path d="m11 16 5-4-5-4v3.001H3v2h8z"></path>
                    </svg>Đăng xuất </a>
            </li>


        </ul>

        <?php

    }
}