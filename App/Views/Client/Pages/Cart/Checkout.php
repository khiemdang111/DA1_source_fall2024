<?php

namespace App\Views\Client\Pages\Cart;

use App\Helpers\AuthHelper;
use App\Views\BaseView;

class Checkout extends BaseView
{
	public static function render($data = null)
	{
		// echo '<pre>';
		// var_dump($data);
		$is_login = AuthHelper::checkLogin();
?>
		<section class="ftco-section">
			<div class="container">

				<form action="/order" method="post" enctype="multipart/form-data">
					<input type="hidden" name="method" value="POST">
					<div class="row ">
						<div class="col-xl-6 ftco-animate">
							<div class="row align-items-end">
								<div class="col-md-6">
									<div class="form-group">
										<label for="firstname">Firt Name</label>
										<input type="text" class="form-control" placeholder="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="lastname">Last Name</label>
										<input type="text" class="form-control" placeholder="">
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="country">State / Country</label>
										<div class="select-wrap">
											<div class="icon"><span class="ion-ios-arrow-down"></span></div>
											<select name="" id="" class="form-control">
												<option value="">France</option>
												<option value="">Italy</option>
												<option value="">Philippines</option>
												<option value="">South Korea</option>
												<option value="">Hongkong</option>
												<option value="">Japan</option>
											</select>
										</div>
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="streetaddress">Street Address</label>
										<input type="text" class="form-control" placeholder="House number and street name">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Appartment, suite, unit etc: (optional)">
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="towncity">Town / City</label>
										<input type="text" class="form-control" placeholder="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="postcodezip">Postcode / ZIP *</label>
										<input type="text" class="form-control" placeholder="">
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="phone">Phone</label>
										<input type="text" class="form-control" placeholder="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="emailaddress">Email Address</label>
										<input type="text" class="form-control" placeholder="">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="country">Phương thức thanh toán</label>
										<div class="select-wrap">
											<div class="icon"><span class="ion-ios-arrow-down"></span></div>
											<select id="" class="form-control" name="PaymentMethod">
												<option value="">Vui lòng chọn ...</option>
												<option value="COD">Thanh toán COD</option>
												<option value="VNPAY">Thanh toán qua VNPAY</option>
												<option value="MOMO">Thanh toán qua MoMo</option>

											</select>
										</div>
									</div>
								</div>
								<div class="w-100"></div>

							</div>
						</div>
						<div class="col-xl-6 ftco-animate">
							<div class="cart-detail cart-total p-3 p-md-4">
								<h3 class="billing-heading mb-4">Tổng cộng giỏ hàng</h3>
								<p class="d-flex">
									<span>Tổng cộng</span>
									<span>$20.60</span>
								</p>
								<p class="d-flex">
									<span>Phí vận chuyển</span>
									<span>$0.00</span>
								</p>
								<p class="d-flex">
									<span>Giảm giá</span>
									<span>$3.00</span>
								</p>
								<hr>
								<p class="d-flex total-price">
									<span>Tổng</span>
									<span>$17.60</span>
								</p>
								<p>
									<button type="submit" class="btn btn-primary py-3 px-4">Đặt hàng</button>
								</p>
							</div>
						</div>
					</div>
				</form>

		</section>

<?php
	}
}
?>