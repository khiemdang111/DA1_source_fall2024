<?php

namespace App\Views\Client\Pages\Product;

use App\Views\BaseView;
use App\Views\Client\Components\Category;

class Index extends BaseView
{
	public static function render($data = null)
	{
		// var_dump($data);

?> 



<section class="ftco-section">
    <div class="container">
        <div class="row">
		<?php
                foreach ($data['products'] as $product):
                  ?>
                <div class="col-md-4 d-flex">
                    <div class="product ftco-animate">
                        <div class="img d-flex align-items-center justify-content-center" 
                             style="background-image: url('<?= APP_URL ?>/public/uploads/products/<?= $product['image'] ?>$product['image']; ?>');">
                            <div class="desc">
                                <p class="meta-prod d-flex">
                                    <a href="#" class="d-flex align-items-center justify-content-center">
                                        <span class="flaticon-shopping-bag"></span>
                                    </a>
                                    <a href="#" class="d-flex align-items-center justify-content-center">
                                        <span class="flaticon-heart"></span>
                                    </a>
                                    <a href="/products/<?= $product['id'] ?>" class="d-flex align-items-center justify-content-center">
                                        <span class="flaticon-visibility"></span>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="text text-center">
                            <?php if ($product['discount_price'] > 0) : ?>
                                <span class="sale">Giảm Giá</span>
                                <p class="mb-0">
                                    <span class="price price-sale"><?php echo number_format($product['price'], 2); ?>$</span>
                                    <span class="price"><?php echo number_format($product['discount_price'], 2); ?>$</span>
                                </p>
                            <?php else : ?>
                                <span class="price"><?php echo number_format($product['price'], 2); ?>$</span>
                            <?php endif; ?>
                            <span class="category"><?php echo $product['name']; ?></span>
                            <h2><?php echo $product['name']; ?></h2>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>




<?php

	}
}
