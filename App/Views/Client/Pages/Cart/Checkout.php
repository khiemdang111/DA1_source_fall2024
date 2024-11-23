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
									</td>
									<td class="">
										<img class="img_cart" src="/public/uploads/products/<?= $cart['data']['image'] ?>" alt="">
									</td>

									<?php
									if ($cart['data']['discount_price'] > 0):
										?>
										<td>
											<div class="d-flex justify-content-center"><strike><?= number_format($cart['data']['price']) ?>
												</strike> <span><del class="margin_vnd">VND</del></span></div>

											<br>
											<?= number_format($cart['data']['discount_price']) ?> VND
										</td>

										<?php

									else:
										?>
										<td>

											<?= number_format($cart['data']['price']) ?> <span>VND</span>
										</td>
										<?php
									endif;
									?>

									<td>
										<form action="/checkout/update" method="post">
											<input type="hidden" name="method" id="" value="PUT">
											<input class="quantity form-control input-number number_cart" type="number" name="quantity"
												value="<?= $cart['quantity'] ?>" onchange="this.form.submit()" class="form-control"
												min=1>
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
												<span><?= number_format($discount_price) ?></span> <span class="margin_vnd"> VND</span>
											</div>

										</td>
										<?php
									else:
										$unit_price = $cart['quantity'] * $cart['data']['price'];
										$total_price += $unit_price;
										?>
										<td>
											<?= number_format($unit_price) ?> VND
										</td>

										<td>
											<form action="/checkout/delete" method="post">
												<input type="hidden" name="method" id="" value="DELETE">
												<input type="hidden" name="id" value="<?= $cart['data']['id'] ?>">
												<button type="submit" class="close">
													<span aria-hidden="true"><i class="fa fa-close"></i></span>
												</button>
											</form>

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

								<div class="col-md-6">
									<div class="form-group">
										<label for="country">Tỉnh</label>
										<div class="select-wrap">
											<div class="icon"><span class="ion-ios-arrow-down"></span></div>
											<select id="province" name="province" class="select-form-order">
											</select>

										</div>
									</div>
								</div>
								<input type="hidden" id="province-input" value="" name="province_">
								<div class=" col-md-6">
									<div class="form-group">
										<label for="country">Huyện</label>
										<div class="select-wrap">
											<div class="icon"><span class="ion-ios-arrow-down"></span></div>
											<select name="district" id="district" class="select-form-order">
												<option value="">Chọn quận</option>
											</select>
										</div>
									</div>
								</div>
								<input type="hidden" id="district-input" name="district_">
								<div class="col-md-6">
									<div class="form-group">
										<label for="country">Phường</label>
										<div class="select-wrap">
											<div class="icon"><span class="ion-ios-arrow-down"></span></div>
											<select name="ward" id="ward" class="select-form-order">
												<option value="">Chọn phường</option>
											</select>
										</div>
									</div>
								</div>
								<input type="hidden" id="ward-input" name="ward_">
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
												<option value="COD">Thanh toán khi nhận hàng</option>
												<option value="VNPAY">Thanh toán qua VNPAY</option>
												<option value="MOMO">Thanh toán qua MoMo</option>

											</select>
										</div>
									</div>
								</div>


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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
			integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
			crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"
			integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ=="
			crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script>

			const host = "https://provinces.open-api.vn/api/";
			var callAPI = (api) => {
				return axios.get(api)
					.then((response) => {
						renderData(response.data, "province");
					});
			}
			callAPI('https://provinces.open-api.vn/api/?depth=1');
			var callApiDistrict = (api) => {
				return axios.get(api)
					.then((response) => {
						renderData(response.data.districts, "district");
					});
			}
			var callApiWard = (api) => {
				return axios.get(api)
					.then((response) => {
						renderData(response.data.wards, "ward");
					});
			}

			var renderData = (array, select) => {
				let row = ' <option  value="">Chọn </option>';
				array.forEach(element => {
					row += `<option value="${element.code}">${element.name}</option>`
				});
				document.querySelector("#" + select).innerHTML = row
			}
			$("#province").change(() => {
				callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
				printResult();
			});
			$("#district").change(() => {
				callApiWard(host + "d/" + $("#district").val() + "?depth=2");
				printResult();
			});
			$("#ward").change(() => {
				printResult();
			})

			var printResult = () => {
				if ($("#district").val() !== "" && $("#province").val() !== "" && $("#ward").val() !== "") {
					// Lấy giá trị từ các dropdown
					let province = $("#province option:selected").text();
					let district = $("#district option:selected").text();
					let ward = $("#ward option:selected").text();
					// Lưu giá trị vào input
					$("#province-input").val(province);
					$("#district-input").val(district);
					$("#ward-input").val(ward);

					// Debug (Kiểm tra giá trị được lưu)
					console.log("Tỉnh:", province, "Huyện:", district, "Phường:", ward);
				}
			};


		</script>


		<?php
	}
}
?>