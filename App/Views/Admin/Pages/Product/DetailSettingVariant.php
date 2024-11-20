<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class DetailSettingVariant  extends BaseView
{
  public static function render($data = null)
  {
    ?>
    <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
        <?php
value:var_dump( $_SESSION['value_variant_combinations']);
die;
        ?>
      </div>
      
      <?php
  }
}
