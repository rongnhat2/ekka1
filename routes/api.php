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


// Route::middleware(['AuthAdmin:admin'])->group(function () {
Route::prefix('admin')->group(function () {
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
    });

});
// });