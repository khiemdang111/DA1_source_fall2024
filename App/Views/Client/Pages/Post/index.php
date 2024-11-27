<?php


namespace App\Views\Client\Pages\Post;


use App\Views\BaseView;

class index extends BaseView
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
            <p class="breadcrumbs mb-0"><span class="mr-2"><a href="/">Trang Chủ <i
                    class="fa fa-chevron-right"></i></a></span> <span>Tin tức <i class="fa fa-chevron-right"></i></span></p>
            <h2 class="mb-0 bread">Tin Tức</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row d-flex">

          <?php
          foreach ($data['posts'] as $item):
            ?>
            <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
              <div class="blog-entry d-md-flex">
                <a href="/Blog_single/<?= $item['id'] ?>" class="block-20 img"
                  style="background-image: url('<?= APP_URL ?>/public/uploads/posts/<?= $item['img'] ?>');">
                </a>
                <div class="text p-4 bg-light">
                  <div class="meta">
                    <p><span class="fa fa-calendar"></span><a href="/Blog_single/<?= $item['id'] ?>">
                        <?= date('d/m/Y', strtotime($item['created_at'])) ?></p>
                  </div>
                  <h3 class="heading mb-3"><a href="/Blog_single/<?= $item['id'] ?>"> <?= $item['title'] ?></a></h3>
                  <p> <?= $item['summary'] ?></p>
                  <a href=" /Blog_single/<?= $item['id'] ?>" class="btn-custom">Xem thêm <span
                      class="fa fa-long-arrow-right"></span></a>

                </div>
              </div>
            </div>
            <?php
          endforeach;
          ?>
        </div>
        <div class="row my-3 justify-content-center">
          <nav aria-label="...">
            <ul class="pagination">
              <?php
              $currentPage = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
              $totalPages = $data['total_pages'];

              $prevPage = $currentPage - 1;
              ?>
              <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= $currentPage > 1 ? '/post?pages=' . $prevPage : '#' ?>">
                  << </a>
              </li>

              <?php
              for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                  <a class="page-link" href="/post?pages=<?= $i ?>"><?= $i ?></a>
                </li>
              <?php endfor; ?>

              <?php
              $nextPage = $currentPage + 1;
              ?>
              <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= $currentPage < $totalPages ? '/post?pages=' . $nextPage : '#' ?>"> >> </a>
              </li>
            </ul>
          </nav>

        </div>
      </div>
    </section>
    <?php

  }
}
