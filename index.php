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
// lọc sản phẩm theo loại
Route::get('/products/categories/{id}','App\Controllers\Client\ProductController@getProductByCategory');



// *** Admin
Route::get('/admin', 'App\Controllers\Admin\HomeController@index');

Route::get('/login', 'App\Controllers\Client\AuthController@Login');
Route::post('/login', 'App\Controllers\Client\AuthController@loginAction');

Route::get('/login-google', 'App\Controllers\Client\GoogleController@loginGoogle');
Route::get('/login-googleAction', 'App\Controllers\Client\GoogleController@callbackGoogle');

Route::get('/logout', 'App\Controllers\Client\AuthController@logout');
// chi tiết tài khoản
Route::get('/users/{id}', 'App\Controllers\Client\AuthController@edit');
Route::put('/users/update/{id}', 'App\Controllers\Client\AuthController@update');


// trang giỏ hàng
Route::get('/cart', 'App\Controllers\Client\CartController@index');
Route::post('/cart/add', 'App\Controllers\Client\CartController@add');
Route::put('/cart/update', 'App\Controllers\Client\CartController@update');
Route::delete('/cart/delete', 'App\Controllers\Client\CartController@deleteItem');
Route::delete('/cart/delete-all', 'App\Controllers\Client\CartController@deleteAll');
// trang đặt hàng
Route::get('/checkout', 'App\Controllers\Client\CartController@checkout');
Route::post('/order', 'App\Controllers\Client\CartController@order');







// thêm bình luận 
Route::post('/comments', 'App\Controllers\Client\CommentController@store');
Route::put('/comments/{id}', 'App\Controllers\Client\CommentController@edit');
Route::delete('/comments/{id}', 'App\Controllers\Client\CommentController@delete');



// *** Admin
Route::get('/admin', 'App\Controllers\Admin\HomeController@index');
// *** Product ***
Route::get('/admin/products', 'App\Controllers\Admin\ProductController@index');
Route::get('/admin/products/create', 'App\Controllers\Admin\ProductController@create');
Route::post('/admin/products', 'App\Controllers\Admin\ProductController@store');
Route::get('/admin/products/{id}', 'App\Controllers\Admin\ProductController@edit');
Route::put('/admin/update/{id}', 'App\Controllers\Admin\ProductController@update');
Route::post('/admin/delete/products/{id}', 'App\Controllers\Admin\ProductController@delete');
Route::get('/admin/productvariant/{id}', 'App\Controllers\Admin\ProductController@createVariant');
Route::post('/admin/productvariant', 'App\Controllers\Admin\ProductController@storeVariant');
Route::get('/admin/variant/add', 'App\Controllers\Admin\ProductController@createAttributeVariant');
Route::post('/admin/addAttribute', 'App\Controllers\Admin\ProductController@storeAttribute');
Route::get('/admin/productvariant/setting', 'App\Controllers\Admin\ProductController@settingVariant');


//  *** Category
// GET /categories (lấy danh sách loại sản phẩm)
Route::get('/admin/categories', 'App\Controllers\Admin\CategoryController@index');
Route::get('/admin/categories/create', 'App\Controllers\Admin\CategoryController@create');
Route::post('/admin/categories', 'App\Controllers\Admin\CategoryController@store');
Route::get('/admin/categories/{id}', 'App\Controllers\Admin\CategoryController@edit');
Route::put('/admin/categories/{id}', 'App\Controllers\Admin\CategoryController@update');
Route::post('/admin/delete/categories/{id}', 'App\Controllers\Admin\CategoryController@delete');





// *** User ***
Route::get('/admin/users', 'App\Controllers\Admin\UserController@index');
Route::get('/admin/users/create', 'App\Controllers\Admin\UserController@create');
Route::post('/admin/users', 'App\Controllers\Admin\UserController@store');
Route::get('/admin/users/{id}', 'App\Controllers\Admin\UserController@edit');
Route::put('/update/user/{id}', 'App\Controllers\Admin\UserController@update');
Route::post('/admin/delete/users/{id}', 'App\Controllers\Admin\UserController@delete');



// *** Post ***
Route::get('/admin/posts', 'App\Controllers\Admin\PostController@index');
Route::get('/admin/posts/create', 'App\Controllers\Admin\PostController@create');
Route::post('/admin/posts', 'App\Controllers\Admin\PostController@store');
Route::get('/admin/posts/{id}', 'App\Controllers\Admin\PostController@edit');
Route::put('/update/posts/{id}', 'App\Controllers\Admin\PostController@update');
Route::post('/admin/delete/{id}', 'App\Controllers\Admin\PostController@delete');
Route::get('/post', 'App\Controllers\Client\PostController@index');
Route::get('/Blog_single/{id}', 'App\Controllers\Client\PostController@Blog_single');


// *** Contact
Route::get('/contact', 'App\Controllers\Client\PostController@Contact');
Route::post('/contact', 'App\Controllers\Client\PostController@PostContact');




// *** Recycle Bin ***
// *** Products
Route::get('/admin/recycle/products', 'App\Controllers\Admin\ProductController@productRecycle');
Route::get('/admin/product/restore/{id}', 'App\Controllers\Admin\ProductController@restore');
Route::post('/admin/product/deletePermanently/{id}', 'App\Controllers\Admin\ProductController@deletePermanently');

// *** Users
Route::get('/admin/recycle/users', 'App\Controllers\Admin\UserController@userRecycle');
Route::get('/admin/user/restore/{id}', 'App\Controllers\Admin\UserController@restore');
Route::post('/admin/user/deletePermanently/{id}', 'App\Controllers\Admin\UserController@deletePermanently');


// *** Posts
Route::get('/admin/recycle/posts', 'App\Controllers\Admin\PostController@postRecycle');
Route::get('/admin/post/restore/{id}', 'App\Controllers\Admin\PostController@restore');
Route::post('/admin/post/deletePermanently/{id}', 'App\Controllers\Admin\PostController@deletePermanently');

// *** Posts
Route::get('/admin/recycle/posts', 'App\Controllers\Admin\PostController@postRecycle');
Route::get('/admin/post/restore/{id}', 'App\Controllers\Admin\PostController@restore');
Route::post('/admin/post/deletePermanently/{id}', 'App\Controllers\Admin\PostController@deletePermanently');
//thống kê
 Route::get('/mail', 'App\Controllers\Client\MailController@index');


Route::dispatch($_SERVER['REQUEST_URI']);
