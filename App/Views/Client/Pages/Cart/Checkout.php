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
			<table class="table table_center">
						<thead class="thead-primary">
							<tr>
								<th class="">Tên sản phẩm</th>
								<th class="">Hình ảnh</th>
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Tổng</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$total_price = 0;
							$i = 0;
							foreach ($data as $cart) :
								if ($cart['data']) :
									$i++;
							?>
									<tr>
										<td>
											<span><?= $cart['data']['name'] ?> </span>
										</td>
										<td class="">
											<img class="img_cart" src="/public/uploads/products/<?= $cart['data']['image'] ?>" alt="">
										</td>

										<?php
										if ($cart['data']['discount_price'] > 0) :
										?>
											<td>
												<div class="d-flex"><strike><?= number_format($cart['data']['price']) ?> </strike> <span><del class="margin_vnd">VND</del></span></div>

												<br>
												<?= number_format($cart['data']['discount_price']) ?> VND
											</td>

										<?php

										else :
										?>
											<td>

												<?= number_format($cart['data']['price']) ?> <span>VND</span>
											</td>
										<?php
										endif;
										?>

										<td>
										<?= $cart['quantity'] ?> 
											
										</td>



										<?php
										if ($cart['data']['discount_price'] > 0) :
											$discount_price = $cart['quantity'] * $cart['data']['discount_price'];
											$total_price += $discount_price;
										?>
											<td>
												<div class="d-flex">
													<span><?= number_format($discount_price) ?></span> <span class="margin_vnd"> VND</span>
												</div>

											</td>
										<?php
										else :
											$unit_price = $cart['quantity'] * $cart['data']['price'];
											$total_price += $unit_price;
										?>
											<td>
												<?= number_format($unit_price) ?> VND
											</td>
										<?php
										endif;
										?>
										
									</tr>



							<?php
								endif;
							endforeach;
							?>

						</tbody>
					</table>
				<form action="/order" method="post" enctype="multipart/form-data">
					<input type="hidden" name="method" value="POST">
					<div class="row ">
						<div class="col-xl-6 ftco-animate">
							<div class="row align-items-end">
								<div class="col-md-6">
									<div class="form-group">
										<label for="firstname">Họ và tên</label>
										<input name="name" type="text" class="form-control" placeholder="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="lastname">Số điện thoại</label>
										<input name="phone" type="text" class="form-control" placeholder="">
									</div>
								</div>
								<div class="w-100"></div>

								<div class="w-100"></div>


								<div class="w-100"></div>


								<div class="w-100"></div>

								<div class="col-md-12">
									<div class="form-group">
										<label for="">Địa chỉ</label>
										<textarea name="address" type="text" class="form-control" placeholder=""></textarea>
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

						<?php
						$total_price = 0;
						$i = 0;
						foreach ($data as $cart) {
							if ($cart['data']) {
								$i++;
								if ($cart['data']['discount_price'] > 0) {
									$total_price += $cart['quantity'] * $cart['data']['discount_price'];
								} else {
									$total_price += $cart['quantity'] * $cart['data']['price'];
								}
							}
						}
						?>
						<div class="col-xl-6 oder_cart">
							<div class="col-xl-12 ftco-animate ">
								<div class="cart-detail cart-total p-3 p-md-4">
									<h3 class="billing-heading mb-4">Tổng cộng giỏ hàng</h3>
									<p class="d-flex">
										<span>Tổng cộng</span>
										<span><?= number_format($total_price) ?></span>
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
										<span><?= number_format($total_price) ?></span>
									</p>
									<p>
										<button type="submit" class="btn btn-primary py-3 px-4">Đặt hàng</button>
									</p>
								</div>
							</div>
						</div>

					</div>
				</form>

		</section>

<?php
	}
}
?>