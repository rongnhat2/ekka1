<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'Customer\DisplayController@index')->name('customer.view.index');
Route::get('news', 'Customer\DisplayController@news')->name('customer.view.news');
Route::get('news-detail', 'Customer\DisplayController@news_detail')->name('customer.view.news_detail');
Route::get('product', 'Customer\DisplayController@product')->name('customer.view.product');
Route::get('category', 'Customer\DisplayController@category')->name('customer.view.category');
Route::get('cart', 'Customer\DisplayController@cart')->name('customer.view.cart');


Route::get('/login', 'Customer\DisplayController@login')->name('customer.view.login');
Route::get('/register', 'Customer\DisplayController@register')->name('customer.view.register');
Route::get('/forgot', 'Customer\DisplayController@forgot')->name('customer.view.forgot');
Route::get('/reset', 'Customer\DisplayController@reset')->name('customer.view.reset');

Route::get('profile', 'Customer\DisplayController@profile')->name('customer.view.profile');
Route::get('checkout', 'Customer\DisplayController@checkout')->name('customer.view.checkout');



Route::middleware(['AuthAdmin:auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/login', 'Admin\DisplayController@login')->name('admin.login');
        Route::post('/login', 'Admin\AuthController@login')->name('admin.login');
    });
});
Route::middleware(['AuthAdmin:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('logout', 'Admin\AuthController@logout')->name('admin.logout');

        Route::get('/', 'Admin\DisplayController@statistic')->name('admin.statistic');

        Route::prefix('carousel')->group(function () {
            Route::get('/', 'Admin\CarouselController@index')->name('admin.carousel.index');
        });
        Route::prefix('news')->group(function () {
            Route::get('/', 'Admin\NewsController@index')->name('admin.news.index');
        });
        Route::prefix('category')->group(function () {
            Route::get('/', 'Admin\CategoryController@index')->name('admin.category.index');
        });
        Route::prefix('trademark')->group(function () {
            Route::get('/', 'Admin\TrademarkController@index')->name('admin.trademark.index');
        });
        Route::prefix('product')->group(function () {
            Route::get('/', 'Admin\ProductController@index')->name('admin.product.index');
        });
        Route::prefix('discount')->group(function () {
            Route::get('/', 'Admin\ProductController@discount')->name('admin.discount.index');
        });
        Route::prefix('warehouse')->group(function () {
            Route::get('/', 'Admin\WarehouseController@index')->name('admin.warehouse.index');
        });
        Route::prefix('order')->group(function () {
            Route::get('/', 'Admin\OrderController@index')->name('admin.order.index');
        });
    });
});