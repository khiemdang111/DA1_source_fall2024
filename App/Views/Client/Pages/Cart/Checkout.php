<?php

namespace App\Views\Client\Pages\Cart;

use App\Helpers\AuthHelper;
use App\Views\BaseView;

class Checkout extends BaseView
{
	public static function render($data = null)
	{
		// echo '<pre>';
		// var_dump($data['voucher']);
		// die;
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
						foreach ($data['cart'] as $cart):
							if ($cart['data']):
								// var_dump($cart['data']['name']);
								// die;
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
											<div class="d-flex justify-content-center">
												<strike><?= number_format($cart['data']['price'], 0, ',', '.') ?>
												</strike> <span><del class="margin_vnd">VND</del></span>
											</div>

											<br>
											<?= number_format($cart['data']['discount_price'], 0, ',', '.') ?> VND
										</td>

										<?php

									else:
										?>
										<td>

											<?= number_format($cart['data']['price'], 0, ',', '.') ?> <span>VND</span>
										</td>
										<?php
									endif;
									?>

									<td>
										<?= $cart['quantity'] ?>
									</td>
									<?php
									if ($cart['data']['discount_price'] > 0):
										$discount_price = $cart['quantity'] * $cart['data']['discount_price'];
										$total_price += $discount_price;
										?>
										<td>
											<div class="d-flex">
												<span><?= number_format($discount_price, 0, ',', '.') ?></span> <span class="margin_vnd">
													VND</span>
											</div>

										</td>
										<?php
									else:
										$unit_price = $cart['quantity'] * $cart['data']['price'];
										$total_price += $unit_price;
										?>
										<td>
											<?= number_format($unit_price, 0, ',', '.') ?> VND

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
										<label for="country">Phường/Xã</label>
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
												<option value="PAYMENT">Chuyển khoản ngân hàng</option>
												<option value="VNPAY">Thanh toán qua VNPAY</option>
											</select>
										</div>
									</div>
								</div>


							</div>
						</div>

						<?php
						$total_price = 0;
						$i = 0;
						foreach ($data['cart'] as $cart) {
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
						<div class="col-md-6">
							<div class="col-md-12 oder_cart mb-2">
								<div class="col-xl-12 ftco-animate ">
									<div class="cart-detail p-3 p-md-4">
										<h3 class="billing-heading mb-4">Phương thức vận chuyển</h3>
										<div class="form-group">
											<div class="col-md-12">
												<div class="radio">
													<label><input type="radio" name="delivery" id="savingshippingGHTK" value="conomy" class="mr-2" />
														Giao hàng tiết kiệm</label><img src="public/uploads/image/Giaohangtietkiem.jpg" alt=""
														width="20%">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<div class="radio">
													<label><input type="radio" name="delivery" value="fast" class="mr-2" id="savingshippingGHN" />
														Giao hàng nhanh</label><img src="public/uploads/image/giaohangnhanh.jpg" alt="" width="20%">
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
							<div class="col-xl-12 oder_cart">
								<div class="col-xl-12 ftco-animate ">
									<div class="cart-detail cart-total p-3 p-md-4">
										<h3 class="billing-heading mb-4">Tổng cộng giỏ hàng</h3>
										<p class="d-flex">
											<span>Tổng cộng</span>
											<span><?= number_format($total_price, 0, ',', '.') ?> VND</span>
										</p>
										<p class="d-flex">
											<span>Phí vận chuyển</span>
											<span id="shippingFee">

											</span>
										</p>
										<p class="d-flex">
											<span>Voucher</span>
											<span id="Voucher">
												<a href="" data-toggle="modal" data-target="#exampleModalCenter2">Chọn voucher để giảm giá </a>
											</span>
										</p>
										<div class="d-flex align-items-center">
    <span>Sử dụng số dư trong ví:</span>
    <input class="mx-2" type="checkbox" id="money-wallet" value="<?= $data['money_wallet']['balance'] ?>">
</div>
<div class="py-4"></div>
<hr>
<p class="d-flex total-price">
    <span>Tổng</span>
    <?php
    if (isset($_SESSION['unit'])):
        $total_price = (float)$total_price - $_SESSION['unit'];
        ?>
        <span id="shippingFee2"><?= number_format($total_price, 0, ',', '.') ?></span>
        <?php
    else:
        ?>
        <span id="shippingFee2"><?= number_format($total_price, 0, ',', '.') ?></span>
        <?php
    endif;
    ?>
    <input type="hidden" id="total" name="total" value="<?= $total_price ?>">
</p>
<p>
    <button type="submit" class="btn btn-primary py-3 px-4">Đặt hàng</button>
</p>
<script>
	document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('money-wallet');
    const shippingFeeElement = document.getElementById('shippingFee2');
    const totalInput = document.getElementById('total');
    const walletBalance = parseFloat(checkbox.value); // Giá trị số dư trong ví
    let originalTotal = parseFloat(totalInput.value); // Giá trị tổng ban đầu từ PHP

    // Lắng nghe sự kiện thay đổi trên checkbox
    checkbox.addEventListener('change', function () {
        let currentTotal = originalTotal;

        if (checkbox.checked) {
            currentTotal -= walletBalance; // Trừ số dư ví
        }

        // Đảm bảo tổng không âm
        if (currentTotal < 0) currentTotal = 0;

        // Cập nhật giá trị hiển thị và input ẩn
        shippingFeeElement.textContent = currentTotal.toLocaleString('vi-VN');
        totalInput.value = currentTotal; // Cập nhật giá trị cho form
    });
});

</script>
								</div>
							</div>
						</div>


					</div>
				</form>

				<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
					aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Chọn mã Voucher </h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<form action="/discountCode" method="post">
								<div class="modal-body">
									<input type="hidden" name="method" value="POST">
									<div id="voucherRadios">
										<?php foreach ($data['voucher'] as $voucher): ?>
											<label>
												<input type="radio" name="name" value="<?= $voucher['name'] ?>" <?= isset($_GET['voucher']) && $_GET['voucher'] === $voucher['id'] ? 'checked' : '' ?>>
												<?= $voucher['name'] ?>
											</label>
											<br>
										<?php endforeach; ?>
									</div>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
									<button type="submit" class="btn btn-primary">Xác nhận</button>
								</div>
							</form>
						</div>
					</div>
				</div>

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
				let row = ' <option  value="">Vui lòng chọn</option>';
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

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
			$(document).ready(function () {
				$('#savingshippingGHTK').change(function () {
					if ($(this).is(':checked')) {
						// Lấy giá trị tỉnh và quận từ form
						var province = $('#province-input').val();
						var district = $('#district-input').val();
						var total = $('#total').val();


						if (province && district) {
							$.ajax({
								url: '/savingshippingGHTK',
								method: 'POST',
								data: {
									type: 'savingshippingGHTK',
									method: "POST",
									total: total,
									province: province,
									district: district
								},
								success: function (response) {

									console.log(response);

									$('#shippingFee').html(response.fee + " VND");
									$('#shippingFee2').html(response.total + " VND");
								},
								error: function (xhr, status, error) {
									console.log('Error:', xhr.responseText);
									$('#shippingFee').html(xhr.responseText + " VND");
									alert('Có lỗi xảy ra khi tính phí giao hàng!');
								}
							});
						} else {
							window.location.href = '/checkout';
						}
					} else {
						$('#shippingFee').html('');
					}
				});
			});
		</script>
		<script>
			$(document).ready(function () {
				$('#savingshippingGHN').change(function () {
					if ($(this).is(':checked')) {
						var district = $('#ward').val();
						var total = $('#total').val();
						console.log(district);
						if (district) {
							$.ajax({
								url: '/savingshippingGHN',
								method: 'POST',
								data: {
									type: 'savingshippingGHN',
									method: "POST",
									total: total,
									district: district
								},
								success: function (response) {
									console.log(response);
									$('#shippingFee').html(response.fee + " VND");
									$('#shippingFee2').html(response.total + " VND");
								},
								error: function (xhr, status, error) {
									console.log('Error:', xhr.responseText);
									$('#shippingFee').html(xhr.responseText + " VND");
									alert('Có lỗi xảy ra khi tính phí giao hàng!');
								}
							});
						} else {
							alert('Vui lòng chọn địa chỉ giao!');
							window.location.href = '/checkout';
						}
					} else {
						$('#shippingFee').html('');
					}
				});
			});
		</script>


		<?php
	}
}
?>