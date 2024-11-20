<?php

namespace App\Views\Client\Pages\Post;

use App\Helpers\AuthHelper;
use App\Views\BaseView;

class Contact extends BaseView
{
	public static function render($data = null)
	{
?>
	<section class="hero-wrap hero-wrap-2" style="background-image: url('<?= APP_URL ?>/public/assets/client/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate mb-5 text-center">
          	<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">TRang chủ <i class="fa fa-chevron-right"></i></a></span> <span>Liên hệ <i class="fa fa-chevron-right"></i></span></p>
            <h2 class="mb-0 bread">Liên Hệ</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section bg-light">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="wrapper px-md-4">
							<div class="row mb-5">
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-map-marker"></span>
				        		</div>
				        		<div class="text">
					            <p><span>Địa chỉ:</span> Toà nhà FPT Polytechnic, Đ. Số 22, Thường Thạnh, Cái Răng, Cần Thơ, Việt Nam</p>
					          </div>
				          </div>
								</div>
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-phone"></span>
				        		</div>
				        		<div class="text">
					            <p><span>Số điện thoại:</span> <a href="tel://1234567920">0789593011</a></p>
					          </div>
				          </div>
								</div>
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-paper-plane"></span>
				        		</div>
				        		<div class="text">
					            <p><span>Email:</span> <a href="mailto:info@yoursite.com"></a></p>
					          </div>
				          </div>
								</div>
								<div class="col-md-3">
									<div class="dbox w-100 text-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-globe"></span>
				        		</div>
				        		<div class="text">
					            <p><span>Website</span> <a href="#"></a></p>
					          </div>
				          </div>
								</div>
							</div>
							<div class="row no-gutters">
								<div class="col-md-7">
									<div class="contact-wrap w-100 p-md-5 p-4">
										
										<h3 class="mb-4">Liên hệ với chúng tôi</h3>
										<form method="post" id="contactForm" name="contactForm" class="contactForm " action="">
											<input type="hidden" name="method" value="POST">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group border-success">
														<label class="label " for="name">Họ và tên</label>
														<input type="text" class="form-control" name="name" id="name" placeholder="Họ và tên">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="email">Địa chỉ email</label>
														<input type="text" class="form-control" name="email" id="email" placeholder="Địa chỉ email">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="label" for="phone">Số điện thoại</label>
														<input type="text" class="form-control" name="phone" id="phone" placeholder="phone">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">

														
														<label class="label" for="message">Nội dung</label>
														<textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Nội dung liên hệ"></textarea>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<button class="btn btn-primary d-grid w-100" type="submit">Gửi</button>
														<div class="submitting"></div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="col-md-5 order-md-first d-flex align-items-stretch">
									<img  src="<?= APP_URL ?>/public/assets/client/images/bg_2.jpg" width="100%" height="70%">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php

	}
}
