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

});
// });