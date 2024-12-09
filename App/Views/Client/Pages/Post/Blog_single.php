<?php

namespace App\Views\Client\Pages\Post;

use App\Helpers\AuthHelper;
use App\Views\BaseView;


class Blog_single extends BaseView
{
  public static function render($data = null)
  {
    ?>
    <section class="hero-wrap hero-wrap-2"
      style="background-image: url('<?= APP_URL ?>/public/assets/client/images/bg_2.jpg');"
      data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate mb-5 text-center">
            <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">TRang chủ <i
                    class="fa fa-chevron-right"></i></a></span> <span>Tin Tức<i class="fa fa-chevron-right"></i></span></p>
            <h2 class="mb-0 bread">Tin Tức</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <?php
          foreach ($data as $item):
            ?>
            <div class="col-lg-12 ftco-animate">
              <!-- <p>
              <img src="<?= APP_URL ?>/public/assets/client/images/<?= $item['img'] ?>" alt="" class="img-fluid">
            </p> -->
              <h2 class="mb-3"><?= $item['title'] ?></h2>
              <p><?= $item['content'] ?></p>


              <?php
          endforeach;
          ?>
            <button class="button" id="shareButton">
              <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon">
                <path
                  d="M307 34.8c-11.5 5.1-19 16.6-19 29.2v64H176C78.8 128 0 206.8 0 304C0 417.3 81.5 467.9 100.2 478.1c2.5 1.4 5.3 1.9 8.1 1.9c10.9 0 19.7-8.9 19.7-19.7c0-7.5-4.3-14.4-9.8-19.5C108.8 431.9 96 414.4 96 384c0-53 43-96 96-96h96v64c0 12.6 7.4 24.1 19 29.2s25 3 34.4-5.4l160-144c6.7-6.1 10.6-14.7 10.6-23.8s-3.8-17.7-10.6-23.8l-160-144c-9.4-8.5-22.9-10.6-34.4-5.4z">
                </path>
              </svg>
              Chia sẻ bài viết
            </button>
            <!-- <div class="tag-widget post-tag-container mb-5 mt-5">
              <div class="tagcloud">
                <a href="#" class="tag-cloud-link">Life</a>
                <a href="#" class="tag-cloud-link">Sport</a>
                <a href="#" class="tag-cloud-link">Tech</a>
                <a href="#" class="tag-cloud-link">Travel</a>
              </div>
            </div>
             -->
            <div class="about-author d-flex p-4 bg-light">
              <div class="bio mr-5">
                <img src="/public/uploads/users/user.png" width="100" alt="Image placeholder"
                  class="img-fluid mb-4 rounded-circle">
              </div>
              <div class="desc">
                <h3>Chào mừng đến với Wine Cần Thơ</h3>
                <p>"Nơi cung cấp những loại rượu hảo hạng từ các thương hiệu nổi
                  tiếng. Chúng tôi mang đến cho bạn những chai rượu đặc sắc, từ rượu vang cao cấp, whisky cho đến các loại
                  rượu mạnh khác, giúp bạn tận hưởng những giây phút thư giãn tuyệt vời. Hãy khám phá bộ sưu tập rượu của
                  chúng tôi và tìm cho mình loại rượu yêu thích!"</p>
              </div>
            </div>



            <!-- .col-md-8 -->
            <div class="col-lg-4 sidebar pl-lg-5 ftco-animate">
              <!-- <div class="sidebar-box">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="fa fa-search"></span>
                  <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                </div>`
              </form>
            </div> -->
              <!-- <div class="sidebar-box ftco-animate">
              <div class="categories">
                <h3>Services</h3>
                <li><a href="#">Relation Problem <span class="fa fa-chevron-right"></span></a></li>
                <li><a href="#">Couples Counseling <span class="fa fa-chevron-right"></span></a></li>
                <li><a href="#">Depression Treatment <span class="fa fa-chevron-right"></span></a></li>
                <li><a href="#">Family Problem <span class="fa fa-chevron-right"></span></a></li>
                <li><a href="#">Personal Problem <span class="fa fa-chevron-right"></span></a></li>
                <li><a href="#">Business Problem <span class="fa fa-chevron-right"></span></a></li>
              </div>
            </div> -->

              <!-- <div class="sidebar-box ftco-animate">
              <h3>Recent Blog</h3>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                    <div><a href="#"><span class="fa fa-user"></span> Admin</a></div>
                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                  </div>
                </div>
              </div>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                    <div><a href="#"><span class="fa fa-user"></span> Admin</a></div>
                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                  </div>
                </div>
              </div>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_3.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                    <div><a href="#"><span class="fa fa-user"></span> Admin</a></div>
                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                  </div>
                </div>
              </div>
            </div> -->

              <!-- <div class="sidebar-box ftco-animate">
              <h3>Tag Cloud</h3>
              <div class="tagcloud">
                <a href="#" class="tag-cloud-link">counsel</a>
                <a href="#" class="tag-cloud-link">problem</a>
                <a href="#" class="tag-cloud-link">family</a>
                <a href="#" class="tag-cloud-link">personal</a>
                <a href="#" class="tag-cloud-link">business</a>
                <a href="#" class="tag-cloud-link">computer</a>
                <a href="#" class="tag-cloud-link">house</a>
                <a href="#" class="tag-cloud-link">technology</a>
              </div>
            </div> -->

              <!-- <div class="sidebar-box ftco-animate">
              <h3>Paragraph</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
            </div>
          </div> -->

            </div>
          </div>
    </section> <!-- .section -->
    <script>
      // Lắng nghe sự kiện nhấn nút chia sẻ
      document.getElementById('shareButton').addEventListener('click', function () {
        const currentUrl = window.location.href; // Lấy URL hiện tại của trang
        const shareData = {
          url: currentUrl,
        };

        if (navigator.share) {
          // Sử dụng Web Share API (chỉ hỗ trợ trên di động và một số trình duyệt)
          navigator.share(shareData)
            .then(() => console.log('Bài viết đã được chia sẻ!'))
            .catch((error) => console.error('Lỗi khi chia sẻ:', error));
        } else {
          // Nếu trình duyệt không hỗ trợ Web Share API, mở các liên kết chia sẻ
          const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`;
          const twitterUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareData.title)}&url=${encodeURIComponent(currentUrl)}`;
          const linkedinUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(currentUrl)}`;

          // Mở cửa sổ mới để chia sẻ
          window.open(facebookUrl, '_blank');
          window.open(twitterUrl, '_blank');
          window.open(linkedinUrl, '_blank');
        }
      });
    </script>
    <?php

  }
}
