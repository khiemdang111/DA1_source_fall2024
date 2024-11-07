<?php

namespace App\Views\Client;

use App\Views\BaseView;
use App\Views\Client\Components\Category;

class Home extends BaseView
{
	public static function render($data = null)
	{
		?>

		<div class="hero-wrap" style="background-image: url('<?= APP_URL ?>/public/assets/client/images/bg_2.jpg');"
			data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row no-gutters slider-text align-items-center justify-content-center">
					<div class="col-md-8 ftco-animate d-flex align-items-end">
						<div class="text w-100 text-center">
							<h1 class="mb-4">Rượu <span>Vang</span> Cao Cấp .</h1>
							<p><a href="#" class="btn btn-primary py-2 px-4">Sản phẩm</a> <a href="#"
									class="btn btn-white btn-outline-white py-2 px-4">Đặt hàng</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<section class="ftco-intro">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-md-4 d-flex">
						<div class="intro d-lg-flex w-100 ftco-animate">
							<div class="icon">
								<span class="flaticon-support"></span>
							</div>
							<div class="text">
								<h2>Hỗ trợ online 24/7</h2>
								<p>Chúng tôi cung cấp những dịch vụ tốt nhất cho bạn, để bạn có thể chọn được 1 loại rượu mà bạn hài lòng.
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 d-flex">
						<div class="intro color-1 d-lg-flex w-100 ftco-animate">
							<div class="icon">
								<span class="flaticon-cashback"></span>
							</div>
							<div class="text">
								<h2>Giá tốt</h2>
								<p>Chúng tôi đưa ra những mức giá phù hợp với bạn, để có thể giúp bạn trải nghiệm những loại rượu khác nhau.
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 d-flex">
						<div class="intro color-2 d-lg-flex w-100 ftco-animate">
							<div class="icon">
								<span class="flaticon-free-delivery"></span>
							</div>
							<div class="text">
								<h2>Vận chuyển miễn phí</h2>
								<p>Hỗ trợ giao hàng nhanh chóng và hoàn toàn miễn phí.</p>
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
	            <h2 class="mb-4">Wine CanTho - Nơi Hội Tụ Những Chai Rượu Cao Cấp</h2>

	            <p>Chúng tôi tự hào là địa chỉ tin cậy cung cấp các sản phẩm rượu cao cấp, từ các dòng vang nổi tiếng, rượu mạnh, cho đến các loại rượu đặc biệt nhập khẩu từ các quốc gia danh tiếng. Tại [Tên Website], bạn có thể dễ dàng lựa chọn các sản phẩm rượu phù hợp với sở thích và nhu cầu của mình, từ những dịp tiệc tùng, lễ hội cho đến các món quà tặng sang trọng.</p>
	            <p>Chúng tôi cam kết cung cấp rượu chính hãng, chất lượng tuyệt vời và dịch vụ chăm sóc khách hàng tận tâm. Đặc biệt, với chính sách miễn phí vận chuyển và miễn phí trả lại trong vòng 30 ngày, bạn có thể yên tâm khi mua sắm tại cửa hàng trực tuyến của chúng tôi.</p>
	            <p class="year">
	            	<strong class="number" data-number="25">0</strong>
		            <span>năm kinh nghiệm trong kinh doanh</span>
	            </p>
	          </div>

					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section ftco-no-pb">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/kind-1.jpg);"></div>
							<h3>Brandy</h3>
						</div>
					</div>
					<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/kind-2.jpg);"></div>
							<h3>Gin</h3>
						</div>
					</div>
					<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/kind-3.jpg);"></div>
							<h3>Rum</h3>
						</div>
					</div>

					<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/kind-5.jpg);"></div>
							<h3>Vodka</h3>
						</div>
					</div>
					<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/kind-6.jpg);"></div>
							<h3>Whiskey</h3>
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
						<h2>Dành cho bạn</h2>
					</div>
				</div>
				<div class="row">
					<?php
					if (count($data) && count($data['products'])):
						?>
						<?php
						foreach ($data['products'] as $item):
							?>
							<div class="col-md-3 d-flex">
								<div class="product ftco-animate">
									<div class="img d-flex align-items-center justify-content-center"
										style="background-image: url(<?= APP_URL ?>/public/uploads/products/<?= $item['image'] ?>);">
										<div class="desc">
											<p class="meta-prod d-flex">
												<a href="#" class="d-flex align-items-center justify-content-center"><span
														class="flaticon-shopping-bag"></span></a>
												<a href="#" class="d-flex align-items-center justify-content-center"><span
														class="flaticon-heart"></span></a>
												<a href="#" class="d-flex align-items-center justify-content-center"><span
														class="flaticon-visibility"></span></a>
											</p>
										</div>
									</div>
									<div class="text text-center">
										<span class="sale"></span>
										<span class="category"><?= $item['category_name']?></span>
										<h2><?= $item['name'] ?></h2>
										<p class="mb-0"><span class="price price-sale"><?= number_format($item['price']) ?></span> <span class="price"><?= number_format($item['price'] - $item['discount_price']) ?></span></p>
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
					<a href="product.html" class="btn btn-primary d-block">Xem tất cả sản phẩm <span
							class="fa fa-long-arrow-right"></span></a>
				</div>
			</div>
			</div>
		</section>

		<section class="ftco-section testimony-section img"
			style="background-image: url(<?= APP_URL ?>/public/assets/client/images/bg_4.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-center mb-5">
					<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
						<span class="subheading">Đánh giá</span>
						<h2 class="mb-3">Khách hàng hài lòng</h2>
					</div>
				</div>
				<div class="row ftco-animate">
					<div class="col-md-12">
						<div class="carousel-testimony owl-carousel ftco-owl">
							<div class="item">
								<div class="testimony-wrap py-4">
									<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
									<div class="text">
										<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
											there live the blind texts.</p>
										<div class="d-flex align-items-center">
											<div class="user-img"
												style="background-image: url(<?= APP_URL ?>/public/assets/client/images/person_1.jpg)"></div>
											<div class="pl-3">
												<p class="name">Roger Scott</p>
												<span class="position">Marketing Manager</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap py-4">
									<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
									<div class="text">
										<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
											there live the blind texts.</p>
										<div class="d-flex align-items-center">
											<div class="user-img"
												style="background-image: url(<?= APP_URL ?>/public/assets/client/images/person_2.jpg)"></div>
											<div class="pl-3">
												<p class="name">Roger Scott</p>
												<span class="position">Marketing Manager</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap py-4">
									<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
									<div class="text">
										<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
											there live the blind texts.</p>
										<div class="d-flex align-items-center">
											<div class="user-img"
												style="background-image: url(<?= APP_URL ?>/public/assets/client/images/person_3.jpg)"></div>
											<div class="pl-3">
												<p class="name">Roger Scott</p>
												<span class="position">Marketing Manager</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap py-4">
									<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
									<div class="text">
										<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
											there live the blind texts.</p>
										<div class="d-flex align-items-center">
											<div class="user-img"
												style="background-image: url(<?= APP_URL ?>/public/assets/client/images/person_1.jpg)"></div>
											<div class="pl-3">
												<p class="name">Roger Scott</p>
												<span class="position">Marketing Manager</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap py-4">
									<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
									<div class="text">
										<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
											there live the blind texts.</p>
										<div class="d-flex align-items-center">
											<div class="user-img"
												style="background-image: url(<?= APP_URL ?>/public/assets/client/images/person_2.jpg)"></div>
											<div class="pl-3">
												<p class="name">Roger Scott</p>
												<span class="position">Marketing Manager</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
  
    <section class="ftco-section testimony-section img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/bg_4.jpg);">
    	<div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
          	<span class="subheading">Lời nhận xét</span>
            <h2 class="mb-3">Khách hàng</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                  <div class="text">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/person_1.jpg)"></div>
                    	<div class="pl-3">
		                    <p class="name">Roger Scott</p>
		                    <span class="position">Marketing Manager</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                  <div class="text">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/person_2.jpg)"></div>
                    	<div class="pl-3">
		                    <p class="name">Roger Scott</p>
		                    <span class="position">Marketing Manager</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                  <div class="text">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/person_3.jpg)"></div>
                    	<div class="pl-3">
		                    <p class="name">Roger Scott</p>
		                    <span class="position">Marketing Manager</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                  <div class="text">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/person_1.jpg)"></div>
                    	<div class="pl-3">
		                    <p class="name">Roger Scott</p>
		                    <span class="position">Marketing Manager</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                  <div class="text">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/person_2.jpg)"></div>
                    	<div class="pl-3">
		                    <p class="name">Roger Scott</p>
		                    <span class="position">Marketing Manager</span>
		                  </div>
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
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Tin tức</span>
            <h2>Tin Tức Gần Đây</h2>
          </div>
        </div>
        <div class="row d-flex">
          <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
          	<div class="blog-entry d-flex">
          		<a href="blog-single.html" class="block-20 img" style="background-image: url('<?= APP_URL ?>/public/assets/client/images/image_1.jpg');">
              </a>
              <div class="text p-4 bg-light">
              	<div class="meta">
              		<p><span class="fa fa-calendar"></span> 23 April 2020</p>
              	</div>
                <h3 class="heading mb-3"><a href="#">The Recipe from a Winemaker’s Restaurent</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                <a href="#" class="btn-custom">Continue <span class="fa fa-long-arrow-right"></span></a>

		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center mb-5">
					<div class="col-md-7 heading-section text-center ftco-animate">
						<span class="subheading">Bài viết</span>
						<h2>Bài viết gần đây</h2>
					</div>
				</div>
				<div class="row d-flex">
					<div class="col-lg-6 d-flex align-items-stretch ftco-animate">
						<div class="blog-entry d-flex">
							<a href="blog-single.html" class="block-20 img"
								style="background-image: url('<?= APP_URL ?>/public/assets/client/images/image_1.jpg');">
							</a>
							<div class="text p-4 bg-light">
								<div class="meta">
									<p><span class="fa fa-calendar"></span> 23 April 2020</p>
								</div>
								<h3 class="heading mb-3"><a href="#">The Recipe from a Winemaker’s Restaurent</a></h3>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
								<a href="#" class="btn-custom">Đọc thêm <span class="fa fa-long-arrow-right"></span></a>

							</div>
						</div>
					</div>
					<div class="col-lg-6 d-flex align-items-stretch ftco-animate">
						<div class="blog-entry d-flex">
							<a href="blog-single.html" class="block-20 img"
								style="background-image: url('<?= APP_URL ?>/public/assets/client/images/image_2.jpg');">
							</a>
							<div class="text p-4 bg-light">
								<div class="meta">
									<p><span class="fa fa-calendar"></span> 23 April 2020</p>
								</div>
								<h3 class="heading mb-3"><a href="#">The Recipe from a Winemaker’s Restaurent</a></h3>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
								<a href="#" class="btn-custom">Đọc thêm <span class="fa fa-long-arrow-right"></span></a>

							</div>
						</div>
					</div>
					<div class="col-lg-6 d-flex align-items-stretch ftco-animate">
						<div class="blog-entry d-flex">
							<a href="blog-single.html" class="block-20 img"
								style="background-image: url('<?= APP_URL ?>/public/assets/client/images/image_3.jpg');">
							</a>
							<div class="text p-4 bg-light">
								<div class="meta">
									<p><span class="fa fa-calendar"></span> 23 April 2020</p>
								</div>
								<h3 class="heading mb-3"><a href="#">The Recipe from a Winemaker’s Restaurent</a></h3>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
								<a href="#" class="btn-custom">Đọc thêm <span class="fa fa-long-arrow-right"></span></a>

							</div>
						</div>
					</div>
					<div class="col-lg-6 d-flex align-items-stretch ftco-animate">
						<div class="blog-entry d-flex">
							<a href="blog-single.html" class="block-20 img"
								style="background-image: url('<?= APP_URL ?>/public/assets/client/images/image_4.jpg');">
							</a>
							<div class="text p-4 bg-light">
								<div class="meta">
									<p><span class="fa fa-calendar"></span> 23 April 2020</p>
								</div>
								<h3 class="heading mb-3"><a href="#">The Recipe from a Winemaker’s Restaurent</a></h3>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
								<a href="#" class="btn-custom">Đọc thêm <span class="fa fa-long-arrow-right"></span></a>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
