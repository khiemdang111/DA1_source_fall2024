<?php

namespace App\Views\Client\Pages\Cart;

use App\Helpers\AuthHelper;
use App\Views\BaseView;

class Index extends BaseView
{
	public static function render($data = null)
	{
		$is_login = AuthHelper::checkLogin();
		//  echo '<pre>';
		//  var_dump($data);
		// die;
?>
		<section class="ftco-section">
			<div class="container">
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
									<tr >
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
												<div class="d-flex"><strike><?= number_format($cart['data']['price']) ?>   </strike> <span><del class="margin_vnd">VND</del></span></div>
												
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
											<form action="/cart/update" method="post">
												<input type="hidden" name="method" id="" value="PUT">
												<input  class="quantity form-control input-number number_cart" type="number" name="quantity" value="<?= $cart['quantity'] ?>" onchange="this.form.submit()" class="form-control" min=1>
												<input type="hidden" name="id" value="<?= $cart['data']['id'] ?>">
												<input type="hidden" name="update-cart-item">
											</form>
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
										<td>
											<form action="/cart/delete" method="post">
												<input type="hidden" name="method" id="" value="DELETE">
												<input type="hidden" name="id" value="<?= $cart['data']['id'] ?>">
												<button type="submit" class="close" >
													<span aria-hidden="true"><i class="fa fa-close"></i></span>
												</button>
											</form>

										</td>
									</tr>



							<?php
								endif;
							endforeach;
							?>

						</tbody>
					</table>


				</div>
				<div class="row justify-content-end">
					<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate_cart">
						<div class="cart-total ">
							<h3>Tổng cộng giỏ hàng</h3>
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
								<span>Total</span>
								<span>$17.60</span>
							</p>
						</div>
						<p class="text-center cart_button"><a href="checkout.html" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
					</div>
				</div>
			</div>
		</section>
<?php

	}
}
