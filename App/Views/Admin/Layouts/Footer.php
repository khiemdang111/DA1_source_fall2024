<?php

namespace App\Views\Admin\Layouts;

use App\Views\BaseView;

class Footer extends BaseView
{
  public static function render($data = null)
  {

    ?>

    <!-- Footer -->

    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= APP_URL ?>/public/assets/admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= APP_URL ?>/public/assets/admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= APP_URL ?>/public/assets/admin/assets/vendor/js/bootstrap.js"></script>
    <script src="<?= APP_URL ?>/public/assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= APP_URL ?>/public/assets/admin/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?= APP_URL ?>/public/assets/admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?= APP_URL ?>/public/assets/admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?= APP_URL ?>/public/assets/admin/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    </body>

    </html>
    <?php
  }
}

?>