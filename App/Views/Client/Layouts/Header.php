<?php

namespace App\Views\Client\Layouts;

use App\Controllers\Client\ProductController;
use App\Helpers\AuthHelper;
use App\Helpers\CartHelper;
use App\Models\Product;
use App\Views\BaseView;

class Header extends BaseView
{
	public static function render($data = null)
	{
		$is_login = AuthHelper::checkLogin();

?>
		<!DOCTYPE html>
		<html lang="en">

		<head>
			<title>WINE CẦN THƠ</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="stylesheet"
				href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
			<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet" />

			<link
				href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap"
				rel="stylesheet">

			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/animate.css">
			<link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/bootstrap.css">
			<link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/owl.carousel.min.css">
			<link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/owl.theme.default.min.css">
			<link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/magnific-popup.css">
			<link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/flaticon.css">
			<link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/style.css">
			<link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/bootstrap/bootrap.css">
		</head>

		<body>
			<div class="content">
				<div class="wrap">
					<div class="container">
						<div class="row">
							<div class="col-md-6 d-flex align-items-center">
								<p class="mb-0 phone pl-md-2">
									<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +00 1234 567</a>
									<a href="#"><span class="fa fa-paper-plane mr-1"></span> youremail@email.com</a>
								</p>
							</div>
							<div class="col-md-6 d-flex justify-content-md-end">
								<div class="social-media mr-4">
									<p class="mb-0 d-flex">
										<a href="#" class="d-flex align-items-center justify-content-center"><span
												class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
										<a href="#" class="d-flex align-items-center justify-content-center"><span
												class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
										<a href="#" class="d-flex align-items-center justify-content-center"><span
												class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
										<a href="#" class="d-flex align-items-center justify-content-center"><span
												class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
									</p>
								</div>
								<div class="reg row justify-content-between">
									<?php
									if ($is_login):
									?>
										<div class="dropdown_hmenu">
											<a class="a_dropdown_hmenu" href="#">Xin Chào,<?= $_SESSION['user']['name'] ?> ▼</a>
											<div class="dropdown-content">
												<a href="/users/<?= $_SESSION['user']['id'] ?>">Thông tin tài khoản</a>
												<a href="#">Đổi mật khẩu</a>
												<a href="/logout">Đăng xuất</a>
											</div>
										</div>
										<!-- <p class="mr-2 text-light">Xin Chào,<?= $_SESSION['user']['name'] ?></p> -->
										<!-- <a href="/logout" class="text-light px-4">Đăng xuất</a> -->
									<?php
									else:
									?>
										<p class="mb-0"><a href="/register" class="mr-2">Đăng ký</a> <a href="/login">Đăng Nhập</a>
										</p>
									<?php
									endif;
									?>
								</div>

							</div>
						</div>
					</div>
				</div>

				<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light menu_header"
					id="ftco-navbar">
					<div class="container">
						<a class="navbar-brand" href="index.html">Wine <span>CanTho</span></a>
						<div class="order-lg-last btn-group">
							<a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false">
								<span class="flaticon-shopping-bag"></span>
								<div class="d-flex justify-content-center align-items-center"><small></small></div>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<?php
								if (isset($_COOKIE['cart'])) {
									$product = new Product();
									$cookie_data = $_COOKIE['cart'];
									$cart_data = json_decode($cookie_data, true);
									if (count($cart_data)) {
										foreach ($cart_data as $key => $value) {
											$product_id = $value['product_id'];
											$result = $product->getOneProduct($product_id);
											$cart_data[$key]['data'] = $result;
										}
										$total_price = 0;
										$i = 0;
										foreach ($cart_data as $cart):
											if ($cart['data']):
												$i++;
								?>
												<div class="dropdown-item d-flex align-items-start" href="#">
													<div class="img"
														style="background-image: url(public/uploads/products/<?= $cart['data']['image'] ?>);">
													</div>
													<div class="text pl-3">
														<h4><?= $cart['data']['name'] ?></h4>
														<?php
														if ($cart['data']['discount_price'] > 0):
															$discount_price = $cart['quantity'] * $cart['data']['discount_price'];
															$total_price += $discount_price;
														?>
															<p class="mb-0"><del><?= number_format($cart['data']['price']) ?> VND</del>
																<?= number_format($cart['data']['discount_price']) ?> VND<span></span></p>
														<?php else:
															$discount_price = $cart['quantity'] * $cart['data']['price'];
															$total_price += $discount_price;
														?>
															<p class="mb-0"><?= number_format($cart['data']['price']) ?> VND</p>
														<?php endif; ?>
														<p class="mb-0"><span class="quantity">Số
																lượng: <?= $cart['quantity'] ?></span></p>
													</div>
													<form action="/home/delete" method="post">
														<input type="hidden" name="method" id="" value="DELETE">
														<input type="hidden" name="id" value="<?= $cart['data']['id'] ?>">
														<button type="submit" class="close">
															<span aria-hidden="true"><i class="fa fa-close"></i></span>
														</button>
													</form>
												</div>


										<?php

											endif;
										endforeach;
										?>
										<h6 class="text-danger text-center mt-1">Tổng : <?= number_format($total_price) ?> VND </h6>
										<a class="dropdown-item text-center btn-link d-block w-100" href="/cart">
											Xem giỏ hàng
											<span class="ion-ios-arrow-round-forward"></span>
										</a>
									<?php
									} else {
									?>
										<h5 class="text-danger text-center pt-3">Không có sản phẩm</h5>
									<?php
									}
								} else {
									?>
									<h5 class="text-danger text-center">Không có sản phẩm</h5>
								<?php
								}
								?>



								<!-- /* From Uiverse.io by TimTrayler */ -->






							</div>

						</div>

						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
							aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
							<span class="oi oi-menu"></span> Menu
						</button>

						<div class="collapse navbar-collapse justify-content-center" id="ftco-nav">
							<ul class="navbar-nav ">
								<li class="nav-item active"><a href="/" class="nav-link">Trang chủ</a></li>
								<li class="nav-item"><a href="about.html" class="nav-link">Giới Thiệu</a></li>
								<li class="nav-item"><a href="/products" class="nav-link">Sản Phẩm</a></li>
								<li class="nav-item"><a href="/post" class="nav-link">Tin Tức</a></li>
								<li class="nav-item"><a href="/contact" class="nav-link">Liên hệ</a></li>
							</ul>
						</div>
						<form action="/search" method="get" id="search-form">
							<div class="searchbar">
								<div class="searchbar-wrapper">
									<div class="searchbar-left">
										<div class="search-icon-wrapper">
											<span class="search-icon searchbar-icon">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
													<path
														d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
													</path>
												</svg>
											</span>
										</div>
									</div>

									<div class="searchbar-center">
										<div class="searchbar-input-spacer"></div>
										<input type="search" class="searchbar-input" name="keywords" value="<?= (isset($_SESSION['keywords']) ? $_SESSION['keywords'] : "") ?>" placeholder="Tìm kiếm">
									</div>

									<div class="searchbar-right">
										<button type="button" id="mic-btn">
											<i class="fas fa-microphone-slash"></i>
										</button>
									</div>

									<p class="info"></p>

								</div>
							</div>
						</form>
					</div>
				</nav>
				<!-- <button class="search"><i class="bi bi-search"></i></button> -->
			</div>


			<source>

	<?php

	}
}

	?>