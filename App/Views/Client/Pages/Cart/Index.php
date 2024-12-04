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
							foreach ($data as $cart):
								if ($cart['data']):
									$i++;
									?>
									<tr>
										<td>
											<span><?= $cart['data']['name'] ?> </span>
											<p>
												<?php
												if (isset($_SESSION['variants_id'])):
													foreach ($_SESSION['variants_id'] as $item):
														?>
														<span class="text-danger"><?= $item['option_name'] ?></span>
														<?php
													endforeach;
												else:
													?>
												<p></p>
												<?php
												endif;
												?>
											</p>
										</td>
										<td class="">
											<img class="img_cart" src="/public/uploads/products/<?= $cart['data']['image'] ?>" alt="">
										</td>

										<?php
										if ($cart['data']['discount_price'] > 0):
											?>
											<td>
												<div class="d-flex"><strike><?= number_format($cart['data']['price'], 0, ',', '.') ?>
													</strike> <span><del class="margin_vnd">VND</del></span></div>
												<br>
												<?= number_format($cart['data']['discount_price'], 0, ',', '.') ?>
												VND
												<p>
													<?php
													if (isset($_SESSION['variants_id'])):
														$isFirst = true; // Biến flag để kiểm tra lần đầu tiên
														foreach ($_SESSION['variants_id'] as $item):
															if ($isFirst): // Chỉ hiển thị ở lần lặp đầu tiên
																?>
																<span class="text-danger"><?= $item['price'] ?></span>
																<?php
																$isFirst = false; // Đặt flag thành false để không hiển thị lần nữa
															endif;
														endforeach;
													else:
														?>
														<span class="text-danger"></span>
														<?php
													endif;
													?>

												</p>
											</td>

											<?php

										else:
											?>
											<td>
												<?= number_format($cart['data']['price'], 0, ',', '.') ?><span>VND</span>

											</td>
											<?php
										endif;
										?>

										<td>
											<form action="/cart/update" method="post">
												<input type="hidden" name="method" id="" value="PUT">
												<input class="quantity form-control input-number number_cart" type="number"
													name="quantity" value="<?= $cart['quantity'] ?>" onchange="this.form.submit()"
													class="form-control" min=1>
												<input type="hidden" name="id" value="<?= $cart['data']['id'] ?>">
												<input type="hidden" name="update-cart-item">
											</form>
										</td>
										<?php
										if ($cart['data']['discount_price'] > 0):
											$discount_price = $cart['quantity'] * $cart['data']['discount_price'];
											$total_price += $discount_price;
											?>
											<td>
												<div class="d-flex">
													<span><?= number_format($discount_price, 0, ',', '.') ?></span> <span
														class="margin_vnd"> VND</span>
												</div>

											</td>
											<?php
										else:
											$unit_price = $cart['quantity'] * $cart['data']['price'];
											$total_price += $unit_price;
											?>
											<td>
												<?= number_format($unit_price, 0, ',', '.') ?>

												VND
											</td>
											<?php
										endif;
										?>
										<td>
											<form action="/cart/delete" method="post">
												<input type="hidden" name="method" id="" value="DELETE">
												<input type="hidden" name="id" value="<?= $cart['data']['id'] ?>">
												<button type="submit" class="close">
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
							
							<p class="d-flex total-price">
								<span>Tổng</span>
								<span><?= number_format($total_price, 0, ',', '.') ?> VND	</span>
							</p>
						</div>

						<?php
						if ($is_login):
							?>
							<p class="text-center cart_button"><a href="/checkout" class="btn btn-primary py-3 px-4">Tiến hành thanh
									toán</a></p>
							<?php
						else:
							?>
							<p class="text-center cart_button"><a href="/login" class="btn btn-primary py-3 px-4">Vui lòng đăng nhập
									để
									thanh toán</a></p>
							<?php
						endif;
						?>

					</div>
				</div>
			</div>
		</section>
		<?php
		unset($_SESSION['variants_id']);
	}
}
