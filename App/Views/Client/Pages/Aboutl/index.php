<?php

namespace App\Views\Client\Pages\Aboutl;

use App\Views\BaseView;

class index extends BaseView
{
    public static function render($data = null)
    {

?>

<section
            class="hero-wrap hero-wrap-2"
            style="background-image: url('/public/uploads/image/bg_2.jpg')"
            data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div
                    class="row no-gutters slider-text align-items-end justify-content-center">
                    <div class="col-md-9 ftco-animate mb-5 text-center">
                        <p class="breadcrumbs mb-0">
                            <span class="mr-2"><a href="/">Tranng chủ <i class="fa fa-chevron-right"></i></a></span>
                            <span>Giới Thiệu  <i class="fa fa-chevron-right"></i></span>
                        </p>
                        <h2 class="mb-0 bread"> Giới Thiệu </h2>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-intro">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-4 d-flex">
                        <div class="intro d-lg-flex w-100 ftco-animate text-center">
                            <div class="icon mx-auto">
                                <span class="flaticon-support"></span>
                            </div>
                            <div class="text">
                                <h2>Hỗ trợ trực tuyến 24/7</h2>
                                <p>Chúng tôi luôn sẵn sàng giúp bạn chọn lựa loại rượu phù hợp và ưng ý nhất.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="intro color-1 d-lg-flex w-100 ftco-animate text-center">
                            <div class="icon mx-auto">
                                <span class="flaticon-cashback"></span>
                            </div>
                            <div class="text">
                                <h2>Giá cả hợp lý</h2>
                                <p>Chúng tôi mang đến những mức giá cạnh tranh, giúp bạn trải nghiệm rượu cao cấp mà không lo ngại.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="intro color-2 d-lg-flex w-100 ftco-animate text-center">
                            <div class="icon mx-auto">
                                <span class="flaticon-free-delivery"></span>
                            </div>
                            <div class="text">
                                <h2>Vận chuyển miễn phí</h2>
                                <p>Dịch vụ giao hàng nhanh chóng, an toàn và hoàn toàn miễn phí.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section ftco-no-pb">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 img img-3 d-flex justify-content-center align-items-center"
                        style="background-image: url(<?= APP_URL ?>/public/assets/client/images/about.jpg);">
                    </div>
                    <div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
                        <div class="heading-section">
                            <span class="subheading">Từ năm 1905</span>
                            <h2 class="mb-4">Wine CanTho - Hội tụ những dòng rượu tinh túy</h2>
                            <p>Chúng tôi là địa chỉ đáng tin cậy chuyên cung cấp các dòng rượu cao cấp, từ vang danh tiếng đến các loại rượu mạnh, nhập khẩu chính hãng từ nhiều quốc gia nổi tiếng.</p>
                            <p>Chúng tôi cam kết chất lượng và dịch vụ tận tâm, với chính sách giao hàng miễn phí và đổi trả linh hoạt trong 30 ngày.</p>
                            <p class="year">
                                <strong class="number" data-number="25">0</strong>
                                <span>năm kinh nghiệm trong ngành rượu</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-4">
                        <div class="sort w-100 text-center ftco-animate">
                            <div class="img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/kind-1.jpg);"></div>
                            <h3>Brandy</h3>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <div class="sort w-100 text-center ftco-animate">
                            <div class="img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/kind-2.jpg);"></div>
                            <h3>Gin</h3>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <div class="sort w-100 text-center ftco-animate">
                            <div class="img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/kind-3.jpg);"></div>
                            <h3>Rum</h3>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <div class="sort w-100 text-center ftco-animate">
                            <div class="img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/kind-5.jpg);"></div>
                            <h3>Vodka</h3>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <div class="sort w-100 text-center ftco-animate">
                            <div class="img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/kind-6.jpg);"></div>
                            <h3>Whiskey</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
    }
}
