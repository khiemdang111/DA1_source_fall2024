<?php


namespace App\Views\Client\Pages\Post;


use App\Views\BaseView;

class index extends BaseView
{
    public static function render($data = null)
    {

?>
    <section class="hero-wrap hero-wrap-2" style="background-image: url('<?= APP_URL ?>/public/assets/client/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate mb-5 text-center">
          	<p class="breadcrumbs mb-0"><span class="mr-2"><a href="/">Trang Chủ <i class="fa fa-chevron-right"></i></a></span> <span>Tin tức <i class="fa fa-chevron-right"></i></span></p>
            <h2 class="mb-0 bread">Tin Tức</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row d-flex">
        <?php
                                foreach ($data as $item):
                                ?>
            
          <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
          	<div class="blog-entry d-md-flex">
          		<a href="blog-single.html" class="block-20 img" style="background-image: url('<?= APP_URL ?>/public/uploads/posts/<?= $item['img'] ?>');">
              </a>
              <div class="text p-4 bg-light">
              	<div class="meta">
              		<p><span class="fa fa-calendar"></span><a href="#"> <?= $item['created_at'] ?></p>
              	</div>
                <h3 class="heading mb-3"><a href="#"> <?= $item['title'] ?></a></h3>
                <p> <?= $item['summary'] ?></p>
                <a href="#" class="btn-custom">Continue <span class="fa fa-long-arrow-right"></span></a>

              </div>
            </div>
          </div>
          <?php
                                endforeach;
                                ?>
       
        
          
          
        </div>
        <!-- <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div> -->
      </div>
    </section>	
<?php

    }
}
