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
      data-stellar-background-ratio="0.5"
    >
      <div class="overlay"></div>
      <div class="container">
        <div
          class="row no-gutters slider-text align-items-end justify-content-center"
        >
          <div class="col-md-9 ftco-animate mb-5 text-center">
            <p class="breadcrumbs mb-0">
              <span class="mr-2"
                ><a href="/"
                  >Tranng chủ <i class="fa fa-chevron-right"></i></a
              ></span>
              <span>Sản phẩm <i class="fa fa-chevron-right"></i></span>
            </p>
            <h2 class="mb-0 bread">Sản Phẩm</h2>
          </div>
        </div>
      </div>
    </section>
        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
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


                                    <div class="col-md-4 d-flex">
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
                                                        <span class="price price-sale"><?= number_format($item['price']) ?></span> <span
                                                            class="price"><?= number_format( $item['discount_price']) ?></span>

                                                    <?php
                                                    else:
                                                    ?>
                                                        <span
                                                            class="price"><?= number_format($item['price']) ?></span>

                                                    <?php endif; ?>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                            <?php

                                endforeach;
                            endif; ?>

                        </div>
                        <div class="row mt-5">
                            <div class="col text-center">
                                <div class="block-27">
                                    <ul>
                                        <li><a href="#">&lt;</a></li>
                                        <li class="active"><span>1</span></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">&gt;</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="sidebar-box ftco-animate">
                            <div class="categories">
                                <h3>Danh mục sản phẩm</h3>
                                <ul class="p-0">

                                    <?php
                                    Category::render();
                                    ?>


                                </ul>
                            </div>
                        </div>

                      
                    </div>
                </div>
            </div>
        </section>




<?php

    }
}
