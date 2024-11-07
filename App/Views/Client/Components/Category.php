<?php

namespace App\Views\Client\Components;

use App\Views\BaseView;

class Category extends BaseView
{
    public static function render($data = null)
    {
?>
        <h5 class="text-center mb-3">Danh mục</h5>
        <nav class="nav flex-column border-right">
            <a class="nav-link active" href="/products">Tất cả</a>
            <?php
            foreach ($data as $item) :
            ?>
                <div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(<?= APP_URL ?>/public/assets/client/images/kind-4.jpg);"></div>
							<h3><?=$item['name']?></h3>
						</div>
						
					</div>
            <?php
            endforeach;
            ?>
        </nav>

<?php
    }
}
