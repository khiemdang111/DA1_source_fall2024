<?php

namespace App\Views\Client\Pages\Product;

use App\Views\BaseView;
use App\Views\Client\Components\Category;

class Index extends BaseView
{
    public static function render($data = null)
    {
        // var_dump($data);

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
                            <span>Sản phẩm <i class="fa fa-chevron-right"></i></span>
                        </p>
                        <h2 class="mb-0 bread">Sản Phẩm</h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-4">
            <div class="container">
                <form action="" method="GET" id="form-control">
                    <div class="row">
                        <div class="form-group col-3">
                            <label for="sort">Sắp xếp</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select id="sort" class="form-control" name="sort" onchange="handleParams('sort', this.value)">
                                    <option value="" selected>Vui lòng chọn</option>
                                    <option value="1" <?= isset($_GET['sort']) && $_GET['sort'] === '1' ? 'selected' : '' ?>>Giá Giảm Dần</option>
                                    <option value="2" <?= isset($_GET['sort']) && $_GET['sort'] === '2' ? 'selected' : '' ?>>Giá Tăng Dần</option>
                                    <option value="3" <?= isset($_GET['sort']) && $_GET['sort'] === '2' ? 'selected' : '' ?>>Sản Phẩm Hot</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label for="origin">Xuất Xứ</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select id="origin" class="form-control" name="origin" onchange="handleParams('origin', this.value)">
                                    <option value="" selected>Vui lòng chọn xuất xứ</option>
                                    <option value="Mỹ"
                                        <?= isset($_GET['origin']) && $_GET['origin'] === "Mỹ" ? 'selected' : '' ?>>
                                        Mỹ
                                    </option>
                                    <option value="Chile"
                                        <?= isset($_GET['origin']) && $_GET['origin'] === "Chile" ? 'selected' : '' ?>>
                                        Chile
                                    </option>
                                    <option value="Ý"
                                        <?= isset($_GET['origin']) && $_GET['origin'] === "Ý" ? 'selected' : '' ?>>
                                        Ý
                                    </option>
                                    <option value="Pháp"
                                        <?= isset($_GET['origin']) && $_GET['origin'] === "Pháp" ? 'selected' : '' ?>>
                                        Pháp
                                    </option>

                                    <option value="Argentina"
                                        <?= isset($_GET['origin']) && $_GET['origin'] === "Argentina" ? 'selected' : '' ?>>
                                        Argentina
                                    </option>
                                    <option value="Tây Ban Nha"
                                        <?= isset($_GET['origin']) && $_GET['origin'] === "Tây Ban Nha" ? 'selected' : '' ?>>
                                        Tây Ban Nha
                                    </option>
                                    <option value="Úc"
                                        <?= isset($_GET['origin']) && $_GET['origin'] === "Úc" ? 'selected' : '' ?>>
                                        Úc
                                    </option>
                                    

                                </select>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label for="origin">Loại sản phẩm</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select id="categories" class="form-control" name="categories" onchange="handleParams('categories', this.value)">
                                    <option value="" selected>Vui lòng chọn loại sản phẩm</option>
                                    <?php foreach ($data['categories'] as $categories): ?>
                                        <option value="<?= $categories['id'] ?>"
                                            <?= isset($_GET['categories']) && $_GET['categories'] === $categories['id'] ? 'selected' : '' ?>>
                                            <?= $categories['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label for="price">Giá Tiền</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select id="price" class="form-control" name="price" onchange="handleParams('price', this.value)">
                                    <option value="0" selected>Vui lòng chọn giá tiền</option>
                                    <option value="0-100000" <?= isset($_GET['price']) && $_GET['price'] === '0-100000' ? 'selected' : '' ?>>Từ 0 đến 100 nghìn</option>
                                    <option value="100000-500000" <?= isset($_GET['price']) && $_GET['price'] === '100000-500000' ? 'selected' : '' ?>>Từ 100 nghìn đến 500 nghìn</option>
                                    <option value="500000-1000000" <?= isset($_GET['price']) && $_GET['price'] === '500000-1000000' ? 'selected' : '' ?>>Từ 500 nghìn đến 1 triệu</option>
                                    <option value="1000000-5000000" <?= isset($_GET['price']) && $_GET['price'] === '1000000-5000000' ? 'selected' : '' ?>>Từ 1 triệu đến 5 triệu</option>
                                    <option value="5000000-10000000" <?= isset($_GET['price']) && $_GET['price'] === '5000000-10000000' ? 'selected' : '' ?>>Từ 5 triệu đến 10 triệu</option>
                                    <option value="10000000-20000000" <?= isset($_GET['price']) && $_GET['price'] === '10000000-20000000' ? 'selected' : '' ?>>Từ 10 triệu đến 20 triệu</option>
                                    <option value="20000000-100000000" <?= isset($_GET['price']) && $_GET['price'] === '20000000-100000000' ? 'selected' : '' ?>>Từ 20 triệu đến 100 triệu</option>
                                    <option value="100000000-1000000000" <?= isset($_GET['price']) && $_GET['price'] === '100000000-1000000000' ? 'selected' : '' ?>>Từ 100 triệu đến 1 tỷ</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </section>
        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row mb-4">
                            <div
                                class="col-md-12 d-flex justify-content-between align-items-center">
                                <h4 class="product-select">Danh sách sản phẩm</h4>
                                <!-- <select class="selectpicker">
                                    <option>Brandy</option>
                                    <option>Gin</option>
                                    <option>Rum</option>
                                    <option>Tequila</option>
                                    <option>Vodka</option>
                                    <option>Whiskey</option>
                                </select> -->
                            </div>
                        </div>
                        <div class="row">

                            <?php
                            if (count($data) && count($data['products'])):
                                foreach ($data['products'] as $item):
                            ?>


                                    <div class="col-md-3 d-flex">
                                        <div class="product ftco-animate">
                                            <div
                                                class="img d-flex align-items-center justify-content-center"
                                                style="background-image: url(<?= APP_URL ?>/public/uploads/products/<?= $item['image'] ?>)">
                                                <div class="desc">
                                                    <div class="meta-prod d-flex">
                                                        <form action="/cart/add" method="post">
                                                            <input type="hidden" name="method" id="" value="POST">
                                                            <input type="hidden" name="id" id="" value="<?= $item['id'] ?>" required>
                                                            <button type="submit" class="d-flex align-items-center justify-content-center"><span class="flaticon-shopping-bag">
                                                                </span></button>
                                                        </form>
                                                        <a href="#" type="submit" class="d-flex align-items-center justify-content-center"><span
                                                                class="flaticon-heart"></span></a>
                                                        <a href="/products/<?= $item['id'] ?>" class="d-flex align-items-center justify-content-center"><span
                                                                class="flaticon-visibility"></span></a>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text text-center">
                                                <span class="category"><?= $item['category_name'] ?></span>
                                                <h2><?= $item['name'] ?></h2>
                                                <p class="mb-0">
                                                    <?php
                                                    if ($item['discount_price'] > 0) :
                                                    ?>
                                                        <span class="price price-sale"><?= number_format($item['price'], 0, ',', '.') ?></span> <span
                                                            class="price"><?= number_format($item['discount_price'], 0, ',', '.') ?></span>

                                                    <?php
                                                    else:
                                                    ?>
                                                        <span
                                                            class="price"><?= number_format($item['price'], 0, ',', '.') ?></span>

                                                    <?php endif; ?>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                            <?php

                                endforeach;
                            endif; ?>

                        </div>

                    </div>


                </div>
            </div>
        </section>

        <script>
            function handleParams(filter, value) {
                const currentUrl = window.location.href;
                const newUrl = new URL(currentUrl);

                const currentValue = newUrl.searchParams.get(filter);

                if (value === "0" || value === "" || value === currentValue) {
                    newUrl.searchParams.delete(filter);
                } else {
                    newUrl.searchParams.set(filter, value);
                }

                window.location.href = newUrl.toString();
            }

            function clearFilters() {
                window.location.href = window.location.pathname;
            }
        </script>



<?php

    }
}
