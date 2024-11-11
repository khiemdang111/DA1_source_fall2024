<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ini_set('log_errors', TRUE); 
ini_set('error_log', './logs/php/php-errors.log');

use App\Route;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once 'config.php';

use App\Helpers\AuthHelper;

 AuthHelper::middleware();



// *** Client
Route::get('/', 'App\Controllers\Client\HomeController@index');
Route::get('/products', 'App\Controllers\Client\ProductController@index');
Route::get('/products/{id}', 'App\Controllers\Client\ProductController@detail');
Route::get('/register', 'App\Controllers\Client\AuthController@Register');
Route::post('/register', 'App\Controllers\Client\AuthController@registerAction');

// *** Admin
Route::get('/admin', 'App\Controllers\Admin\HomeController@index');

Route::get('/login', 'App\Controllers\Client\AuthController@Login');
Route::post('/login', 'App\Controllers\Client\AuthController@loginAction');


//  *** Category
// GET /categories (lấy danh sách loại sản phẩm)
Route::get('/admin/categories', 'App\Controllers\Admin\CategoryController@index');

// GET /categories/create (hiển thị form thêm loại sản phẩm)
Route::get('/admin/categories/create', 'App\Controllers\Admin\CategoryController@create');

// POST /categories (tạo mới một loại sản phẩm)
Route::post('/admin/categories', 'App\Controllers\Admin\CategoryController@store');

// GET /categories/{id} (lấy chi tiết loại sản phẩm với id cụ thể)
Route::get('/admin/categories/{id}', 'App\Controllers\Admin\CategoryController@edit');

// PUT /categories/{id} (update loại sản phẩm với id cụ thể)
Route::put('/admin/categories/{id}', 'App\Controllers\Admin\CategoryController@update');

// DELETE /categories/{id} (delete loại sản phẩm với id cụ thể)
Route::delete('/admin/categories/{id}', 'App\Controllers\Admin\CategoryController@delete');


// chi tiết sp 


// thêm bình luận 
Route::post('/comments', 'App\Controllers\Client\CommentController@store');
// thêm bình luận 
Route::put('/comments/{id}', 'App\Controllers\Client\CommentController@edit');
Route::delete('/comments/{id}', 'App\Controllers\Client\CommentController@delete');

// *** Product ***
Route::get('/admin/products', 'App\Controllers\Admin\ProductController@index');
Route::get('/admin/products/create', 'App\Controllers\Admin\ProductController@create');
Route::post('/admin/products', 'App\Controllers\Admin\ProductController@store');
Route::get('/admin/products/{id}', 'App\Controllers\Admin\ProductController@edit');
Route::put('/admin/update/{id}', 'App\Controllers\Admin\ProductController@update');
Route::post('/admin/delete/{id}', 'App\Controllers\Admin\ProductController@delete');
// lọc sản phẩm theo loại
Route::get('/products/categories/{id}','App\Controllers\Client\ProductController@getProductByCategory');


// trang giỏ hàng
Route::get('/cart', 'App\Controllers\Client\CartController@index');
Route::post('/cart/add', 'App\Controllers\Client\CartController@add');
Route::put('/cart/update', 'App\Controllers\Client\CartController@update');
Route::delete('/cart/delete', 'App\Controllers\Client\CartController@deleteItem');
Route::delete('/cart/delete-all', 'App\Controllers\Client\CartController@deleteAll');
// trang đặt hàng
Route::get('/checkout', 'App\Controllers\Client\CartController@checkout');

// *** User ***
Route::get('/admin/users', 'App\Controllers\Admin\UserController@index');
Route::get('/admin/users/create', 'App\Controllers\Admin\UserController@create');
Route::post('/admin/users', 'App\Controllers\Admin\UserController@store');
Route::get('/admin/users/{id}', 'App\Controllers\Admin\UserController@edit');
Route::put('/update/user/{id}', 'App\Controllers\Admin\UserController@update');
Route::post('/admin/delete/{id}', 'App\Controllers\Admin\UserController@delete');



// *** Post ***
Route::get('/admin/posts', 'App\Controllers\Admin\PostController@index');
Route::get('/admin/posts/create', 'App\Controllers\Admin\PostController@create');
Route::post('/admin/posts', 'App\Controllers\Admin\PostController@store');
Route::get('/admin/posts/{id}', 'App\Controllers\Admin\PostController@edit');
Route::put('/update/posts/{id}', 'App\Controllers\Admin\PostController@update');
Route::post('/admin/delete/{id}', 'App\Controllers\Admin\PostController@delete');






// *** Recycle Bin ***
Route::get('/admin/recycle/products', 'App\Controllers\Admin\ProductController@productRecycle');
Route::get('/admin/recycle/users', 'App\Controllers\Admin\UserController@userRecycle');


Route::dispatch($_SERVER['REQUEST_URI']);
