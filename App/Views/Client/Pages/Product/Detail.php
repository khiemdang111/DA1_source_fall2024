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
        <section class="hero-wrap hero-wrap-2" style="background-image: url('/public/uploads/image/bg_2.jpg');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-end justify-content-center">
                    <div class="col-md-9 ftco-animate mb-5 text-center">
                        <p class="breadcrumbs mb-0"><span class="mr-2"><a href="/">Trang chủ <i class="fa fa-chevron-right"></i></a></span> <span><a href="product.html">Products <i class="fa fa-chevron-right"></i></a></span> <span>Products Single <i class="fa fa-chevron-right"></i></span></p>
                        <h2 class="mb-0 bread">Chi tiết sản phẩm</h2>
                    </div>
                </div>
            </div>
        </section>


        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-5 ftco-animate">
                        <a href="" class="image-popup prod-img-bg"><img width="100%" height="100%" src="<?= APP_URL ?>/public/uploads/products/<?= $data['product'][0]['image'] ?>" class="img-fluid" alt="Colorlib Template"></a>
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
                        if ($data['product'][0]['discount_price'] > 0) :
                        ?>
                            <p class="price_product text-danger"><del><?= number_format($data['product'][0]['discount_price'])  ?> VND</del></p>
                            <p class="price_product"><span><?= number_format($data['product'][0]['price'])  ?> VND</span></p>
                        <?php
                        else :
                        ?>

                            <p class="price_product"><span><?= number_format($data['product'][0]['price'])  ?> VND</span></p>
                        <?php
                        endif;
                        ?>
                        <p>
                            <?= $data['product'][0]['description'] ?>
                        </p>


                        <form action="/cart/add" method="post">
                            <div class="row mt-4">
                                <div class="input-group col-md-6 d-flex mb-3">


                                    <input type="hidden" name="method" id="" value="POST">

                                    <span class="input-group-btn mr-2">
                                        <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="number" class="number_cart p-1 m-2 number_input_cart" value="1" min="1" max="100">
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
                            <button type="submit" class="btn btn-primary add_to_cart">Thêm vào giỏ hàng</button> <a href="/cart" class="btn btn-primary buy_now">Mua ngay</a>
                        </form>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12 nav-link-wrap">
                        <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Mô tả</a>
                            <a class="nav-link ftco-animate mr-lg-1" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Bình luận</a>
                            <a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Đánh giá</a>
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
                                                    <?php if (isset($data) && isset($data['comments']) && $data && $data['comments']) :
                                                        foreach ($data['comments'] as $item) :
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
                                                                    endif; ?>


                                                                </div>
                                                                <div class="comment-text w-100 ">
                                                                    <h6 class="font-medium"><?= $item['name'] ?> - <?= $item['username'] ?></h6>
                                                                    <span class="m-b-15 d-block"><?= $item['content'] ?></span>
                                                                    <div class="my-2">
                                                                        <span class="text-muted float-right mx-3"><?= $item['date'] ?></span>

                                                                        <?php
                                                                        if (isset($data) && $is_login  && $_SESSION['user']['id'] === $item['user_id']) :
                                                                        ?>


                                                                            <button type="button" class="btn-sm" data-toggle="collapse" data-target="#<?= $item['username'] ?><?= $item['id'] ?>" aria-expanded="false" aria-controls="<?= $item['username'] ?><?= $item['id'] ?>">Sửa</button>
                                                                            <form action="/comments/<?= $item['id'] ?>" method="post" onsubmit="return confirm('Chắc chưa?')" style="display: inline-block">

                                                                                <input type="hidden" name="method" value="DELETE" id="">
                                                                                <input type="hidden" name="product_id" value="<?= $data['product'][0]['id'] ?>" id="">
                                                                                <button type="submit" class="btn btn-danger">Xoá</button>

                                                                            </form>
                                                                            <div class="collapse" id="<?= $item['username'] ?><?= $item['id'] ?>">
                                                                                <div class="card card-body mt-5 comment_select">
                                                                                    <form action="/comments/<?= $item['id'] ?>" method="post">
                                                                                        <input type="hidden" name="method" value="PUT" id="">
                                                                                        <input type="hidden" name="product_id" value="<?= $data['product'][0]['id'] ?>" id="">
                                                                                        <div class="form-group">
                                                                                            <label for="">Bình luận</label>
                                                                                            <textarea class="form-control rounded-0" name="content" id="" rows="3" placeholder="Nhập bình luận..."><?= $item['content'] ?></textarea>
                                                                                        </div>
                                                                                        <div class="comment-footer">
                                                                                            <button type="submit" class="button_comment">Gửi</button>
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
                                                    else :
                                                        ?>
                                                        <h5 class="commnets_no ">Chưa có bình luận</h5>
                                                    <?php
                                                    endif;

                                                    ?>
                                                    <?php
                                                    if (isset($data) && $is_login) :
                                                    ?>


                                                        <div class="d-flex flex-row comment-row">

                                                            <div class="p-2">
                                                                <?php
                                                                if ($is_login) :
                                                                ?>
                                                                    <?php
                                                                    if ($_SESSION['user']['avatar'] === null || $_SESSION['user']['avatar'] === ""):
                                                                    ?>
                                                                        <img src="<?= APP_URL ?>/public/uploads/users/user.png" alt="user" width="50" class="rounded-circle">
                                                                    <?php
                                                                    else :
                                                                    ?>
                                                                        <img src="<?= APP_URL ?>/public/uploads/users/<?= $_SESSION['user']['avatar'] ?>" alt="user" width="50" class="rounded-circle">

                                                                    <?php
                                                                    endif;
                                                                    ?>
                                                                <?php
                                                                else :
                                                                ?>
                                                                    <img class="img_account" src="<?= APP_URL ?>/public/uploads/users/user.png" alt="" width="40%">
                                                                <?php
                                                                endif; ?>
                                                            </div>
                                                            <div class="comment-text w-100 magin">
                                                                <h6 class="font-medium"><?= $_SESSION['user']['name'] ?> - <?= $_SESSION['user']['username'] ?></h6>
                                                                <form action="/comments" method="post">
                                                                    <input type="hidden" name="method" value="POST" id="">
                                                                    <input type="hidden" name="product_id" value="<?= $data['product'][0]['id'] ?>">
                                                                    <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id'] ?>">
                                                                    <input type="hidden" name="status" value="1">
                                                                    <div class="form-group">
                                                                        <label for="">Bình luận</label>
                                                                        <textarea class="form-control rounded-0" name="content" id="" rows="3" placeholder="Nhập bình luận..."></textarea>
                                                                    </div>
                                                                    <div class="comment-footer">
                                                                        <button type="submit" class="button_comment">Gửi</button>
                                                                    </div>
                                                                </form>


                                                            </div>
                                                        </div>
                                                    <?php
                                                    else :
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
                                        <h3 class="mb-4">23 Reviews</h3>
                                        <div class="review">
                                            <div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
                                            <div class="desc">
                                                <h4>
                                                    <span class="text-left">Jacob Webb</span>
                                                    <span class="text-right">25 April 2020</span>
                                                </h4>
                                                <p class="star">
                                                    <span>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                    <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                </p>
                                                <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                            </div>
                                        </div>
                                        <div class="review">
                                            <div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
                                            <div class="desc">
                                                <h4>
                                                    <span class="text-left">Jacob Webb</span>
                                                    <span class="text-right">25 April 2020</span>
                                                </h4>
                                                <p class="star">
                                                    <span>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                    <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                </p>
                                                <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                            </div>
                                        </div>
                                        <div class="review">
                                            <div class="user-img" style="background-image: url(images/person_3.jpg)"></div>
                                            <div class="desc">
                                                <h4>
                                                    <span class="text-left">Jacob Webb</span>
                                                    <span class="text-right">25 April 2020</span>
                                                </h4>
                                                <p class="star">
                                                    <span>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                    <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                </p>
                                                <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="rating-wrap">
                                            <h3 class="mb-4">Give a Review</h3>
                                            <p class="star">
                                                <span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    (98%)
                                                </span>
                                                <span>20 Reviews</span>
                                            </p>
                                            <p class="star">
                                                <span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    (85%)
                                                </span>
                                                <span>10 Reviews</span>
                                            </p>
                                            <p class="star">
                                                <span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    (98%)
                                                </span>
                                                <span>5 Reviews</span>
                                            </p>
                                            <p class="star">
                                                <span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    (98%)
                                                </span>
                                                <span>0 Reviews</span>
                                            </p>
                                            <p class="star">
                                                <span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    (98%)
                                                </span>
                                                <span>0 Reviews</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center pb-5">
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <span class="subheading">Rượu vang hảo hạn</span>
                        <h2>Sản phẩm liên quan</h2>
                    </div>
                </div>
                <div class="row">
                    <!-- <?php
                            if (count($data) && count($data['relatedProducts'])):

                            ?> -->
                    <?php
                                foreach ($data['relatedProducts'] as $relatedProducts):
                    ?>
                        <div class="col-md-3 d-flex">
                            <div class="product ftco-animate">
                                <div class="img d-flex align-items-center justify-content-center"
                                    style="background-image: url(<?= APP_URL ?>/public/uploads/products/<?= $relatedProducts['image'] ?>);">
                                    <div class="desc">
                                        <div class="meta-prod d-flex">
                                            <form action="/cart/add" method="post">
                                                <input type="hidden" name="method" id="" value="POST">
                                                <input type="hidden" name="id" id="" value="<?= $relatedProducts['id'] ?>" required>
                                                <button type="submit" class="d-flex align-items-center justify-content-center"><span class="flaticon-shopping-bag">
                                                    </span></button>
                                            </form>
                                            <a href="#" type="submit" class="d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-heart"></span></a>
                                            <a href="/products/<?= $relatedProducts['id'] ?>" class="d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-visibility"></span></a>

                                        </div>
                                    </div>
                                </div>
                                <div class="text text-center">
                                    <span class="sale"></span>
                                    <span class="category"><?= $relatedProducts['category_name'] ?></span>
                                    <h2><?= $relatedProducts['name'] ?></h2>
                                    <p class="mb-0">
                                        <?php
                                        if ($relatedProducts['discount_price'] > 0) :
                                        ?>
                                            <span class="price price-sale"><?= number_format($relatedProducts['price']) ?></span> <span
                                                class="price"><?= number_format($relatedProducts['price'] - $relatedProducts['discount_price']) ?></span>

                                        <?php
                                        else:
                                        ?>
                                            <span
                                                class="price"><?= number_format($relatedProducts['price']) ?></span>

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
