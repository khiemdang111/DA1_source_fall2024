<?php
define('APP_URL', getenv('APP_URL'));
define("DB_HOST", getenv('DB_HOST'));
define('DB_USERNAME', getenv('DB_USERNAME'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_NAME', getenv('DB_NAME'));

// set timezone
date_default_timezone_set('Asia/Ho_Chi_Minh');

spl_autoload_register(function ($class) {
    include 'app/' . str_replace('\\', '/', $class) . '.php';
});

define('GOOGLE_CLIENT_ID', getenv('GOOGLE_CLIENT_ID'));
define('GOOGLE_CLIENT_SECRET', getenv('GOOGLE_CLIENT_SECRET'));
define('GOOGLE_REDIRECT_URL', getenv('GOOGLE_REDIRECT_URL'));

// Start session
if (!session_id()) {
    session_start();
}
