<?php

namespace App\Views\Client\Layouts;

use App\Controllers\Client\ProductController;
use App\Helpers\AuthHelper;
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
			<title>Liquor Store - Free Bootstrap 4 Template by Colorlib</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="stylesheet"
				href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

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
										<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i
													class="sr-only">Facebook</i></span></a>
										<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i
													class="sr-only">Twitter</i></span></a>
										<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i
													class="sr-only">Instagram</i></span></a>
										<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i
													class="sr-only">Dribbble</i></span></a>
									</p>
								</div>
								<div class="reg row justify-content-between">
									<?php
									if ($is_login):
									?>
										<div class="dropdown_hmenu">
											<a class="a_dropdown_hmenu" href="#">Xin Chào,<?= $_SESSION['user']['name'] ?> ▼</a>
											<div class="dropdown-content">
												<a href="/">Thông tin tài khoản</a>
												<a href="#">Đổi mật khẩu</a>
												<a href="#">Đăng xuất</a>
											</div>
										</div>
										<!-- <p class="mr-2 text-light">Xin Chào,<?= $_SESSION['user']['name'] ?></p> -->
										<a href="/logout" class="text-light px-4">Đăng xuất</a>
									<?php
									else:
									?>
										<p class="mb-0"><a href="/register" class="mr-2">Đăng ký</a> <a href="/login">Đăng Nhập</a></p>
									<?php
									endif;
									?>
								</div>

							</div>
						</div>
					</div>
				</div>

				<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light menu_header" id="ftco-navbar">
					<div class="container">
						<a class="navbar-brand" href="index.html">Wine <span>CanTho</span></a>
						<div class="order-lg-last btn-group">
							<a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true"
								aria-expanded="false">
								<span class="flaticon-shopping-bag"></span>
								<div class="d-flex justify-content-center align-items-center"><small>3</small></div>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								
								<div class="dropdown-item d-flex align-items-start" href="#">
									<div class="img" style="background-image: url(images/prod-1.jpg);"></div>
									<div class="text pl-3">
										<h4>Bacardi 151</h4>
										<p class="mb-0"><a href="#" class="price">$25.99</a></p>
										<p class="mb-0"><a href="#" class="price"> $25.99</a><span class="quantity ml-3">Quantity: 01</span></p>
									</div>
								</div>
								<a class="dropdown-item text-center btn-link d-block w-100" href="/cart">
									Xem giỏ hàng
									<span class="ion-ios-arrow-round-forward"></span>
								</a>





							</div>
						</div>

						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
							aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
							<span class="oi oi-menu"></span> Menu
						</button>

						<div class="collapse navbar-collapse" id="ftco-nav">
							<ul class="navbar-nav ml-auto">
								<li class="nav-item active"><a href="/" class="nav-link">Trang chủ</a></li>
								<li class="nav-item"><a href="about.html" class="nav-link">Giới Thiệu</a></li>
								<li class="nav-item"><a href="/products" class="nav-link">Sản Phẩm</a></li>
								<li class="nav-item"><a href="blog.html" class="nav-link">Tin Tức</a></li>
								<li class="nav-item"><a href="contact.html" class="nav-link">Liên hệ</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</div>




	<?php

	}
}

	?>