<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('customer')->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('get', 'Customer\CategoryController@get')->name('customer.category.get');
    });
    Route::prefix('product')->group(function () {
        Route::get('get-all', 'Customer\ProductController@get_all')->name('customer.product.get.all');
        // 
        // 
        // Route::get('get-discount', 'Customer\ProductController@get_discount')->name('customer.product.get.discount');
        // Route::get('get-discount-first', 'Customer\ProductController@get_discount_first')->name('customer.product.get.discount');

        // 
        // 
        // Route::get('get-related/{id}', 'Customer\ProductController@get_related')->name('customer.product.get.related');
        // Route::get('get-data-category', 'Customer\ProductController@get_data_category')->name('admin.product.get_data_category');

        Route::get('get-one-cart/{id}', 'Customer\ProductController@get_one_cart')->name('customer.product.get.cart');
        Route::get('get-related/{id}', 'Customer\ProductController@get_related')->name('customer.product.get.related');
        Route::get('get-one/{id}', 'Customer\ProductController@get_one')->name('customer.product.get.one');
        Route::get('get-trending', 'Customer\ProductController@get_trending')->name('customer.product.get.trending');
        Route::get('get-best-sale', 'Customer\ProductController@get_best_sale')->name('customer.product.get.best_sale');
        Route::get('get-new-arrivals', 'Customer\ProductController@get_new_arrivals')->name('customer.product.get.new_arrivals');
        Route::get('get-with-category/{id}', 'Customer\ProductController@get_with_category')->name('admin.product.get_with_category');
    });
    Route::prefix('order')->group(function () {
        Route::post('create', 'Customer\OrderController@create')->name('customer.order.create');
        Route::get('get/{id}', 'Customer\OrderController@get')->name('customer.order.get');
    });
    Route::prefix('profile')->group(function () {
        Route::get('get', 'Customer\CustomerController@get_profile')->name('customer.profile.get');
        Route::post('update-profile', 'Customer\CustomerController@update_profile')->name('customer.profile.update');
        Route::get('get-order', 'Customer\CustomerController@get_order')->name('customer.profile.get_order');

        Route::post('update-password', 'Customer\CustomerController@update_password')->name('customer.password.update');
    });
});


// Route::middleware(['AuthAdmin:admin'])->group(function () {
Route::prefix('admin')->group(function () {

    Route::prefix('order')->group(function () {
        Route::get('get', 'Admin\OrderController@get')->name('admin.order.get');
        Route::get('get-one', 'Admin\OrderController@get_one')->name('admin.order.get');
        Route::post('/update', 'Admin\OrderController@update')->name('admin.order.update');
    });

    Route::prefix('statistic')->group(function () {
        Route::get('get-total', 'Admin\OrderController@get_total')->name('admin.order.get_total');
        Route::get('get-best-sale', 'Admin\OrderController@get_best_sale')->name('admin.order.get_best_sale');
        Route::get('get-customer', 'Admin\OrderController@get_customer')->name('admin.order.get_customer');
    });

    Route::post('post-image', 'Admin\ProductController@imageUpload')->name('admin.image.post');
    Route::prefix('category')->group(function () {
        Route::get('get', 'Admin\CategoryController@get')->name('admin.category.get');
        Route::get('/get-one/{id}', 'Admin\CategoryController@get_one')->name('admin.category.get_one');
        Route::post('store', 'Admin\CategoryController@store')->name('admin.category.store');
        Route::post('/update', 'Admin\CategoryController@update')->name('admin.category.update');
        Route::get('/delete/{id}', 'Admin\CategoryController@delete')->name('admin.category.delete');
    });

    Route::prefix('brand')->group(function () {
        Route::get('get', 'Admin\BrandController@get')->name('admin.brand.get');
        Route::get('/get-one/{id}', 'Admin\BrandController@get_one')->name('admin.brand.get_one');
        Route::post('store', 'Admin\BrandController@store')->name('admin.brand.store');
        Route::post('/update', 'Admin\BrandController@update')->name('admin.brand.update');
        Route::get('/delete/{id}', 'Admin\BrandController@delete')->name('admin.brand.delete');
    });

    Route::prefix('color')->group(function () {
        Route::get('get', 'Admin\ColorController@get')->name('admin.color.get');
        Route::get('/get-one/{id}', 'Admin\ColorController@get_one')->name('admin.color.get_one');
        Route::post('store', 'Admin\ColorController@store')->name('admin.color.store');
        Route::post('/update', 'Admin\ColorController@update')->name('admin.color.update');
        Route::get('/delete/{id}', 'Admin\ColorController@delete')->name('admin.color.delete');
    });

    Route::prefix('size')->group(function () {
        Route::get('get', 'Admin\SizeController@get')->name('admin.size.get');
        Route::get('/get-one/{id}', 'Admin\SizeController@get_one')->name('admin.size.get_one');
        Route::post('store', 'Admin\SizeController@store')->name('admin.size.store');
        Route::post('/update', 'Admin\SizeController@update')->name('admin.size.update');
        Route::get('/delete/{id}', 'Admin\SizeController@delete')->name('admin.size.delete');
    });

    Route::prefix('material')->group(function () {
        Route::get('get', 'Admin\MaterialController@get')->name('admin.size.get');
        Route::get('/get-one/{id}', 'Admin\MaterialController@get_one')->name('admin.material.get_one');
        Route::post('store', 'Admin\MaterialController@store')->name('admin.material.store');
        Route::post('/update', 'Admin\MaterialController@update')->name('admin.material.update');
        Route::get('/delete/{id}', 'Admin\MaterialController@delete')->name('admin.material.delete');
    });

    Route::prefix('product')->group(function () {
        Route::get('get', 'Admin\ProductController@get')->name('admin.product.get');
        Route::get('/get-one/{id}', 'Admin\ProductController@get_one')->name('admin.product.get_one');
        Route::post('store', 'Admin\ProductController@store')->name('admin.product.store');
        Route::post('/update', 'Admin\ProductController@update')->name('admin.product.update');
        Route::get('/delete/{id}', 'Admin\ProductController@delete')->name('admin.product.delete');

        Route::get('get-var', 'Admin\ProductController@get_var')->name('admin.product.get_var');
    });

    Route::prefix('warehouse')->group(function () {
        Route::post('store', 'Admin\WarehouseController@store')->name('admin.warehouse.store');
        Route::get('get-history', 'Admin\WarehouseController@get_history')->name('admin.warehouse.get_history');
        Route::get('get-ware-one/{id}', 'Admin\WarehouseController@get_ware_one')->name('admin.warehouse.get_ware_one');
    });
});
// });