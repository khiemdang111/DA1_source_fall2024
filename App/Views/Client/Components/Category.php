<?php

namespace App\Views\Client\Components;

use App\Models\Category as ModelsCategory;
use App\Views\BaseView;

class Category extends BaseView
{
    public static function render($data = null)
    {
?>
        
                <?php
                $category = new ModelsCategory();
                $data_user = $category->getAllCategoryByStatus();
                foreach ($data_user as $item) :
                ?>
                    <li>
                        <a href="/products/categories/<?= $item['id'] ?>"><?= $item['name'] ?> <span class="fa fa-chevron-right"></span></a>
                    </li>
                <?php
                endforeach;
                ?>
            
<?php
    }
}
