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
    <section class="mt-3">
            <div class="container">
                <form action="/products/filter" method="POST" id="form-control">
                <input type="hidden" name="POST">
                        <div class="row">

                        <div class="form-group col-3">
                            <label for="sort">Sắp xếp</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select id="sort" class="form-control" name="sort">
                                    <option value="0" >Vui lòng chọn </option>
                                    <option value="1" <?= isset($_GET['sort']) && $_GET['sort'] === '1' ? "selected" : "" ?>>Giá Giảm Dần</option>
                                    <option value="2" <?= isset($_GET['sort']) && $_GET['sort'] === '2' ? "selected" : "" ?>>Giá Tăng Dần</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label for="origin">Xuất Xứ</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select id="origin" class="form-control" name="origin">
                                <option value="">Vui lòng chọn xuất xứ</option>
                                <?php 
                          foreach($data['origins'] as $origins ) :
                          ?>
                          <option value="<?=  $origins['id']  ?>"><?=  $origins['name']  ?></option>
                          <?php 
                          endforeach;
                          ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label for="volume">Thể Tích</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select id="volume" class="form-control" name="volume">
                                    <option value="0">Vui lòng chọn thể tích </option>
                                    <option value="1">300ml</option>
                                    <option value="2">450ml</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label for="country">Giá Tiền</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select id="price" class="form-control" name="price">
                                    <option value="0">Vui lòng chọn giá tiền</option>
                                    <option value="1">1-500000</option>
                                    <option value="2">500000-1000000</option>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script type="text/javascript">
    $(document).ready(function () {
       
        $('#form-control select').change(function () {
            var selectName = $(this).attr('name'); 
            var selectValue = $(this).val(); 
            var dataToSend = {}; 
            dataToSend[selectName] = selectValue;

            // Kiểm tra dữ liệu trước khi gửi
            console.log("Dữ liệu gửi qua AJAX:", dataToSend);

            // Thực hiện gửi AJAX
            $.ajax({
                url: '/products/filter',
                method: 'POST',          
                data: dataToSend,        
                success: function (response) {
                    console.log("Kết quả trả về từ server:", response);

                  
                   
                        $('#result').html(productsHtml); // Hiển thị sản phẩm
                   
                },
                error: function () {
                    $('#result').html('<p style="color:red;">Có lỗi xảy ra. Vui lòng thử lại.</p>'); // Hiển thị lỗi
                }
            });
        });
    });
</script>
</script>

</script> 


<?php

    }
}
