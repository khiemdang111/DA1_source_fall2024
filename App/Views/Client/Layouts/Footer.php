<?php

namespace App\Views\Client\Layouts;

use App\Views\BaseView;

class Footer extends BaseView
{
  public static function render($data = null)
  {
?>

    <footer class="ftco-footer">
      <div class="container">
        <div class="row mb-5">
          <div class="col-sm-12 col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2 logo"><a href="#">Wine <span>CanTho</span></a></h2>
              <p>Hãy khám phá bộ sưu tập rượu đa dạng của chúng tôi và trải nghiệm những giây phút thưởng thức tuyệt vời!</p>
              <ul class="ftco-footer-social list-unstyled mt-2">
                <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-12 col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Tài khoản của tôi</h2>
              <ul class="list-unstyled">
                <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Tài khoản của tôi</a></li>
                <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Đăng ký</a></li>
                <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Đăng nhập</a></li>
                <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Đơn hàng của tôi</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-12 col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Thông tin</h2>
              <ul class="list-unstyled">
                <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Về chúng tôi</a></li>
                <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Danh mục sản phẩm</a></li>
                <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Liên hệ</a></li>
                <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Điều khoản &amp; Điều kiện</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-12 col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Liên kết nhanh</h2>
              <ul class="list-unstyled">
                <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Người dùng mới</a></li>
                <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Trung tâm trợ giúp</a></li>
                <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Báo cáo spam</a></li>
                <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Câu hỏi thường gặp</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-12 col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Có câu hỏi?</h2>
              <div class="block-23 mb-3">
                <ul>
                  <li><span class="icon fa fa-map-marker"></span><span class="text">203 Đường Giả, Thành phố Núi, San Francisco, California, USA</span></li>
                  <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">070 472 5597</span></a></li>
                  <li><a href="#"><span class="icon fa fa-paper-plane pr-4"></span><span class="text">winecantho@gmail.com.com</span></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <p class="mb-0" style="color: rgba(255,255,255,.5);">
        <!-- Liên kết đến Colorlib không thể bị gỡ bỏ. Mẫu này được cấp phép theo CC BY 3.0. -->
        Bản quyền &copy;<script>
          document.write(new Date().getFullYear());
        </script> Tất cả các quyền được bảo lưu | Mẫu này được tạo với <i class="fa fa-heart color-danger" aria-hidden="true"></i> bởi <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
        <!-- Liên kết đến Colorlib không thể bị gỡ bỏ. Mẫu này được cấp phép theo CC BY 3.0. -->
      </p>

      </div>
      </div>
      </div>
      </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
      </svg></div>

    <script src="<?= APP_URL ?>/public/assets/client/js/voiceSearch.js"></script>
    <script src="<?= APP_URL ?>/public/assets/client/js/ratings.js"></script>


    <script src="<?= APP_URL ?>/public/assets/client/js/jquery.min.js"></script>
    <script src="<?= APP_URL ?>/public/assets/client/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="<?= APP_URL ?>/public/assets/client/js/popper.min.js"></script>
    <script src="<?= APP_URL ?>/public/assets/client/js/bootstrap.min.js"></script>
    <script src="<?= APP_URL ?>/public/assets/client/js/jquery.easing.1.3.js"></script>
    <script src="<?= APP_URL ?>/public/assets/client/js/jquery.waypoints.min.js"></script>
    <script src="<?= APP_URL ?>/public/assets/client/js/jquery.stellar.min.js"></script>
    <script src="<?= APP_URL ?>/public/assets/client/js/owl.carousel.min.js"></script>
    <script src="<?= APP_URL ?>/public/assets/client/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= APP_URL ?>/public/assets/client/js/jquery.animateNumber.min.js"></script>
    <script src="<?= APP_URL ?>/public/assets/client/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="<?= APP_URL ?>/public/assets/client/js/google-map.js"></script>
    <script src="<?= APP_URL ?>/public/assets/client/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
      $(document).ready(function() {

        var quantitiy = 0;
        $('.quantity-right-plus').click(function(e) {

          // Stop acting like a button
          e.preventDefault();
          // Get the field name
          var quantity = parseInt($('#quantity').val());

          // If is not undefined

          $('#quantity').val(quantity + 1);


          // Increment

        });

        $('.quantity-left-minus').click(function(e) {
          // Stop acting like a button
          e.preventDefault();
          // Get the field name
          var quantity = parseInt($('#quantity').val());

          // If is not undefined

          // Increment
          if (quantity > 0) {
            $('#quantity').val(quantity - 1);
          }
        });

      });
    </script>
    </body>

    </html>


<?php

    // unset($_SESSION['success']);
    // unset($_SESSION['error']);
  }
}

?>