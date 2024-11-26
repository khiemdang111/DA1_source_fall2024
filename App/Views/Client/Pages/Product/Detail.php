<?php

namespace App\Views\Client\Pages\Product;

use App\Helpers\AuthHelper;
use App\Views\BaseView;

class Detail extends BaseView
{
    public static function render($data = null)
    {
        $is_login = AuthHelper::checklogin();
        // echo '<pre>';
        // var_dump($data);
        // die;
?>
        <!-- giao diện mới -->
        <section class="hero-wrap hero-wrap-2" style="background-image: url('/public/uploads/image/bg_2.jpg');"
            data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-end justify-content-center">
                    <div class="col-md-9 ftco-animate mb-5 text-center">
                        <p class="breadcrumbs mb-0"><span class="mr-2"><a href="/">Trang chủ <i
                                        class="fa fa-chevron-right"></i></a></span> <span><a href="product.html">Products <i
                                        class="fa fa-chevron-right"></i></a></span> <span>Products Single <i
                                    class="fa fa-chevron-right"></i></span></p>
                        <h2 class="mb-0 bread">Chi tiết sản phẩm</h2>
                    </div>
                </div>
            </div>
        </section>


        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-5 ftco-animate">
                        <a href="" class="image-popup prod-img-bg"><img width="100%" height="100%"
                                src="<?= APP_URL ?>/public/uploads/products/<?= $data['product'][0]['image'] ?>"
                                class="img-fluid" alt="Colorlib Template"></a>
                    </div>
                    <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                        <h3><?= $data['product'][0]['name'] ?></h3>
                        <div class="rating d-flex">
                            <p class="text-left mr-4">
                                <a href="#" class="mr-2">5.0</a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                            </p>
                            <p class="text-left mr-4">
                                <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
                            </p>
                            <p class="text-left">
                                <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
                            </p>
                        </div>

                        <?php
                        if ($data['product'][0]['discount_price'] > 0):
                        ?>
                            <p class="price_product text-danger"><del><?= number_format($data['product'][0]['discount_price']) ?>
                                    VND</del></p>
                            <p class="price_product"><span><?= number_format($data['product'][0]['price']) ?> VND</span></p>
                        <?php
                        else:
                        ?>

                            <p class="price_product"><span><?= number_format($data['product'][0]['price']) ?> VND</span></p>
                        <?php
                        endif;
                        ?>
                        <p>
                            <?= $data['product'][0]['short_description'] ?>
                        </p>
                        <div class="form-group">
                            <?php
                            $processed_ids_cli = [];
                            foreach ($data['variant'] as $itemVariant_opt) {
                                if (in_array($itemVariant_opt['variant_name'], $processed_ids_cli)) {
                                    // Bỏ qua nếu variant_name đã tồn tại
                                    continue;
                                }
                                // Thêm variant_name vào danh sách đã xử lý
                                $processed_ids_cli[] = $itemVariant_opt['variant_name'];

                                // Reset $countinput cho mỗi nhóm variant_name
                                $countinput = 1;
                            ?>
                                <td value="<?= $itemVariant_opt['variant_name'] ?>">
                                    <div class="mt-3">
                                        <h6><?= $itemVariant_opt['variant_name'] ?></h6>
                                        <div class="row">
                                            <?php
                                            foreach ($data['variant'] as $itemVariant_value):
                                                if ($itemVariant_value['variant_name'] === $itemVariant_opt['variant_name']):
                                            ?>
                                                    <div class="radio-inputs">
                                                        <label>
                                                            <input class="radio-input" type="radio"
                                                                name="enginev-<?= $itemVariant_opt['option_name'] . '-' . $countinput ?>"
                                                                value="<?= $itemVariant_value['option_name'] ?>">
                                                            <span class="radio-tile">
                                                                <span class="radio-label"><?= $itemVariant_value['option_name'] ?></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                            <?php
                                                // Tăng $countinput sau mỗi lần tạo input

                                                endif;
                                            endforeach;
                                            $countinput++;
                                            ?>
                                        </div>
                                    </div>
                                </td>
                            <?php
                            }
                            ?>
                        </div>
                        <form action="/cart/add" method="post">
                            <div class="row mt-4">
                                <div class="input-group col-md-6 d-flex mb-3">
                                    <input type="hidden" name="method" id="" value="POST">

                                    <span class="input-group-btn mr-2">
                                        <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="number" class="number_cart p-1 m-2 number_input_cart"
                                        value="1" min="1" max="100">
                                    <input type="hidden" name="id" id="" value="<?= $data['product'][0]['id'] ?>">
                                    <span class="input-group-btn ml-2">
                                        <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>

                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <p style="color: #000;">Số lượt xem : <?= $data['product'][0]['view'] ?></p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary add_to_cart">Thêm vào giỏ hàng</button> <a href="/cart"
                                class="btn btn-primary buy_now">Mua ngay</a>
                        </form>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12 nav-link-wrap">
                        <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill"
                                href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Mô tả</a>
                            <a class="nav-link ftco-animate mr-lg-1" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2"
                                role="tab" aria-controls="v-pills-2" aria-selected="false">Bình luận</a>
                            <a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab"
                                aria-controls="v-pills-3" aria-selected="false">Đánh giá</a>
                        </div>
                    </div>
                    <div class="col-md-12 tab-wrap">
                        <div class="tab-content bg-light" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">
                                <div class="p-4">
                                    <h3 class="mb-4"><?= $data['product'][0]['name'] ?></h3>
                                    <p><?= $data['product'][0]['description'] ?></p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-day-2-tab">
                                <div class="p-4">

                                    <div class="row d-flex justify-content-center mt-100 mb-100">
                                        <div class="col-lg-12">
                                            <div class="card comment_product">
                                                <div class="card-body text-center">
                                                    <h4 class="card-title">Bình luận mới nhất</h4>
                                                </div>
                                                <div class="comment-widgets">
                                                    <?php if (isset($data) && isset($data['comments']) && $data && $data['comments']):
                                                        foreach ($data['comments'] as $item):
                                                    ?>
                                                            <!-- Comment Row -->
                                                            <div class="d-flex flex-row comment-row m-t-0 my-3">
                                                                <div class="p-2">
                                                                    <?php
                                                                    if ($item['avatar']) :
                                                                    ?>
                                                                        <img class="rounded-circle" src="<?= APP_URL ?>/public/uploads/image/<?= $item['avatar'] ?>" alt="" width="50">
                                                                    <?php
                                                                    else :
                                                                    ?>
                                                                        <img class="rounded-circle" src="<?= APP_URL ?>/public/uploads/image/user.png" alt="" width="45px">
                                                                    <?php
                                                                    endif;
                                                                    ?>
                                                                </div>
                                                                <div class="comment-text w-100 ">
                                                                    <h6 class="font-medium"><?= $item['name'] ?> -
                                                                        <?= $item['username'] ?>
                                                                    </h6>
                                                                    <span class="m-b-15 d-block"><?= $item['content'] ?></span>
                                                                    <div class="my-2">
                                                                        <span
                                                                            class="text-muted float-right mx-3"><?= $item['date'] ?></span>
                                                                        <?php
                                                                        if (isset($data) && $is_login && $_SESSION['user']['id'] === $item['user_id']):
                                                                        ?>


                                                                            <button type="button" class="btn-sm" data-toggle="collapse"
                                                                                data-target="#<?= $item['username'] ?><?= $item['id'] ?>"
                                                                                aria-expanded="false"
                                                                                aria-controls="<?= $item['username'] ?><?= $item['id'] ?>">Sửa</button>
                                                                            <form action="/comments/<?= $item['id'] ?>" method="post"
                                                                                onsubmit="return confirm('Chắc chưa?')"
                                                                                style="display: inline-block">

                                                                                <input type="hidden" name="method" value="DELETE" id="">
                                                                                <input type="hidden" name="product_id"
                                                                                    value="<?= $data['product'][0]['id'] ?>" id="">
                                                                                <button type="submit" class="btn btn-danger">Xoá</button>

                                                                            </form>
                                                                            <div class="collapse"
                                                                                id="<?= $item['username'] ?><?= $item['id'] ?>">
                                                                                <div class="card card-body mt-5 comment_select">
                                                                                    <form action="/comments/<?= $item['id'] ?>"
                                                                                        method="post">
                                                                                        <input type="hidden" name="method" value="PUT"
                                                                                            id="">
                                                                                        <input type="hidden" name="product_id"
                                                                                            value="<?= $data['product'][0]['id'] ?>" id="">
                                                                                        <div class="form-group">
                                                                                            <label for="">Bình luận</label>
                                                                                            <textarea class="form-control rounded-0"
                                                                                                name="content" id="" rows="3"
                                                                                                placeholder="Nhập bình luận..."><?= $item['content'] ?></textarea>
                                                                                        </div>
                                                                                        <div class="comment-footer">
                                                                                            <button type="submit"
                                                                                                class="button_comment">Gửi</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>

                                                                        <?php
                                                                        endif;
                                                                        ?>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        endforeach;
                                                    else:
                                                        ?>
                                                        <h5 class="commnets_no ">Chưa có bình luận</h5>
                                                    <?php
                                                    endif;

                                                    ?>
                                                    <?php
                                                    if (isset($data) && $is_login):
                                                    ?>


                                                        <div class="d-flex flex-row comment-row">

                                                            <div class="p-2">
                                                                <?php
                                                                if ($is_login):
                                                                ?>
                                                                    <?php
                                                                    if ($_SESSION['user']['avatar'] === null || $_SESSION['user']['avatar'] === ""):
                                                                    ?>
                                                                        <img src="<?= APP_URL ?>/public/uploads/users/user.png" alt="user"
                                                                            width="50" class="rounded-circle">
                                                                    <?php
                                                                    else:
                                                                    ?>
                                                                        <img src="<?= APP_URL ?>/public/uploads/users/<?= $_SESSION['user']['avatar'] ?>"
                                                                            alt="user" width="50" class="rounded-circle">

                                                                    <?php
                                                                    endif;
                                                                    ?>
                                                                <?php
                                                                else:
                                                                ?>
                                                                    <img class="img_account"
                                                                        src="<?= APP_URL ?>/public/uploads/users/user.png" alt=""
                                                                        width="40%">
                                                                <?php
                                                                endif; ?>
                                                            </div>
                                                            <div class="comment-text w-100 magin">
                                                                <h6 class="font-medium"><?= $_SESSION['user']['name'] ?> -
                                                                    <?= $_SESSION['user']['username'] ?>
                                                                </h6>
                                                                <form action="/comments" method="post">
                                                                    <input type="hidden" name="method" value="POST" id="">
                                                                    <input type="hidden" name="product_id"
                                                                        value="<?= $data['product'][0]['id'] ?>">
                                                                    <input type="hidden" name="user_id"
                                                                        value="<?= $_SESSION['user']['id'] ?>">
                                                                    <input type="hidden" name="status" value="1">
                                                                    <div class="form-group">
                                                                        <label for="">Bình luận</label>
                                                                        <textarea class="form-control rounded-0" name="content"
                                                                            id="" rows="3"
                                                                            placeholder="Nhập bình luận..."></textarea>
                                                                    </div>
                                                                    <div class="comment-footer">
                                                                        <button type="submit" class="button_comment">Gửi</button>
                                                                    </div>
                                                                </form>


                                                            </div>
                                                        </div>
                                                    <?php
                                                    else:
                                                    ?>
                                                        <h6 class="mx-3">Vui lòng đăng nhập để bình luận</h6>
                                                    <?php
                                                    endif;
                                                    ?>
                                                </div>


                                            </div>
                                        </div>
                                    </div>


                                    <!-- <h3 class="mb-4">Manufactured By Liquor Store</h3>
                                    <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p> -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-day-3-tab">
                                <div class="row p-4">

                                    <div class="col-md-7">
                                        <h3 class="mb-4"><?= $data['countRating']['total_reviews'] ?> Đánh giá</h3>
                                        <?php
                                        foreach ($data['rating'] as $item):
                                            // var_dump($item);

                                        ?>
                                            <div class="review">
                                                <div class="user-img" style="background-image: url(<?= APP_URL ?>/public/uploads/users/<?= $item['avatar'] ?>)"></div>
                                                <div class="desc">
                                                    <h5>
                                                        <span class="text-left"> <?= $item['username'] ?></span>

                                                    </h5>
                                                    <span class=""> <?= $item['created'] ?></span>

                                                    <p class="star">
                                                        <span>
                                                            <?php
                                                            // Hiển thị sao dựa trên giá trị rating
                                                            for ($i = 1; $i <= 5; $i++):
                                                                if ($i <= $item['rating']):
                                                            ?>
                                                                    <i class="fa fa-star text-warning"></i>
                                                                <?php else: ?>
                                                                    <i class="fa fa-star text-light"></i>
                                                            <?php
                                                                endif;
                                                            endfor;
                                                            ?>
                                                        </span>
                                                        <span class="text-right">
                                                            <a href="#" class="reply"><i class="icon-reply"></i></a>
                                                        </span>
                                                    </p>
                                                    <p> <?= $item['content'] ?></p>
                                                </div>
                                            </div>
                                        <?php
                                        endforeach;

                                        ?>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="rating-wrap">
                                            <h3 class="mb-4">Đưa ra đánh giá</h3>
                                            <?php foreach ($data['average_rating'] as $item): ?>
                                                <p class="star">
                                                    <span>
                                                        <?php

                                                        for ($i = 1; $i <= 5; $i++):
                                                            if ($i <= $item['rating']):
                                                        ?>
                                                                <i class="fa fa-star text-warning"></i>
                                                            <?php else: ?>
                                                                <i class="fa fa-star text-light"></i>
                                                            <?php endif; ?>
                                                        <?php endfor; ?>
                                                        (<?= number_format($item['percentage'], 0) ?>%)
                                                    </span>
                                                    <span><?= $item['total_reviews'] ?> Reviews</span>
                                                </p>
                                            <?php endforeach; ?>

                                        </div>
                                        <?php
                                        if (isset($data) && $is_login):
                                        ?>
                                            <button class="col-md-12 btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModalCenter">Gửi đánh giá</button>
                                        <?php
                                        else:
                                        ?>
                                            <h5 class="mt-3">Vui lòng đăng nhập để đánh giá</h5>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="/products/rating">
                                            <input type="hidden" name="method" value="POST" id="">
                                            <input type="hidden" name="product_id"
                                                value="<?= $data['product'][0]['id'] ?>">
                                            <input type="hidden" name="user_id"
                                                value="<?= $_SESSION['user']['id'] ?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Đánh giá & nhận xét</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="<?= APP_URL ?>/public/uploads/products/<?= $data['product'][0]['image'] ?>" alt="" width="130px" height="70px">
                                                    </div>
                                                    <div class="col-8">
                                                        <h4><?= $data['product'][0]['name'] ?></h4>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <h5 class="modal-title">Nội dung đánh giá</h5>
                                                    <div class="mt-1 text-center">
                                                        <i class="fa fa-star fa-lg star-light submit_star" id="submit_star_1" data-rating="1" aria-hidden="true"></i>
                                                        <i class="fa fa-star fa-lg star-light submit_star" id="submit_star_2" data-rating="2" aria-hidden="true"></i>
                                                        <i class="fa fa-star fa-lg star-light submit_star" id="submit_star_3" data-rating="3" aria-hidden="true"></i>
                                                        <i class="fa fa-star fa-lg star-light submit_star" id="submit_star_4" data-rating="4" aria-hidden="true"></i>
                                                        <i class="fa fa-star fa-lg star-light submit_star" id="submit_star_5" data-rating="5" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="mt-3">
                                                        <label for="user_review">Nội dung</label>
                                                        <textarea id="user_review" name="user_review" cols="10" rows="5" class="form-control" placeholder="Viết đánh giá của bạn"></textarea>
                                                    </div>
                                                </div>
                                                <!-- Hidden Inputs -->
                                                <input type="hidden" id="rating_data" name="rating_data" value="0">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-primary">Gửi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- Input hidden để lưu rating -->


                        </div>



                    </div>
                </div>
            </div>
            </div>
        </section>
        <section class="mb-5">
            <div class="container">
                <div class="row justify-content-center pb-5">
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <span class="subheading">Rượu vang hảo hạn</span>
                        <h2>Dành cho bạn</h2>
                    </div>
                </div>
                <div class="row">
                    <!-- <?php
                            if (count($data) && count($data['recommended'])):
                            ?> -->
                    <?php
                                foreach ($data['recommended'] as $recommended):
                    ?>
                        <div class="col-md-3 d-flex">
                            <div class="product ftco-animate">
                                <div class="img d-flex align-items-center justify-content-center"
                                    style="background-image: url(<?= APP_URL ?>/public/uploads/products/<?= $recommended['image'] ?>);">
                                    <div class="desc">
                                        <div class="meta-prod d-flex">
                                            <form action="/cart/add" method="post">
                                                <input type="hidden" name="method" id="" value="POST">
                                                <input type="hidden" name="id" id="" value="<?= $recommended['id'] ?>" required>
                                                <button type="submit" class="d-flex align-items-center justify-content-center"><span
                                                        class="flaticon-shopping-bag">
                                                    </span></button>
                                            </form>
                                            <a href="#" type="submit" class="d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-heart"></span></a>
                                            <a href="/products/<?= $recommended['id'] ?>"
                                                class="d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-visibility"></span></a>

                                        </div>
                                    </div>
                                </div>
                                <div class="text text-center">
                                    <span class="sale"></span>
                                    <span class="category"><?= $recommended['category_name'] ?></span>
                                    <h2><?= $recommended['name'] ?></h2>
                                    <p class="mb-0">
                                        <?php
                                        if ($recommended['discount_price'] > 0):
                                        ?>
                                            <span class="price price-sale"><?= number_format($recommended['price']) ?></span> <span
                                                class="price"><?= number_format($recommended['price'] - $recommended['discount_price']) ?></span>

                                        <?php
                                        else:
                                        ?>
                                            <span class="price"><?= number_format($recommended['price']) ?></span>

                                        <?php endif; ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php
                                endforeach;
                    ?>
                </div>
            </div>
        <?php
                            endif;
        ?>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="/products" class="btn btn-primary d-block">Xem tất cả sản phẩm <span
                        class="fa fa-long-arrow-right"></span></a>
            </div>
        </div>
        </div>
        </section>



<?php

    }
}
