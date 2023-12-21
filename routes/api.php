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
Route::group(['middleware' => 'api', 'namespace' => 'Api'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('refresh', 'AuthController@refresh');
        Route::get('/me', 'AuthController@me');
        Route::get('/danh-sach-cua-hang', 'StoreController@listStore')->name('listStore');
        Route::get('/danh-sach-ban/{storeId}', 'StoreController@listTable')->name('listTable');
        Route::get('/chi-tiet-ban/{storeId}/{tableId}', 'StoreController@detailTable')->name('detailTable');
        Route::get('/danh-sach-mon', 'StoreController@listFood')->name('listFood');
        Route::post('/them-mon-dang-dung', 'StoreController@addFoodUse')->name('addFoodUse');
        Route::post('/update-mon-dang-dung', 'StoreController@updateFoodUse')->name('updateFoodUse');
        Route::post('/xoa-mon-dang-dung', 'StoreController@removeFoodUse')->name('removeFoodUse');
        Route::post('/danh-sach-mon-dang-dung', 'StoreController@listFoodUse')->name('listFoodUse');
        Route::post('/danh-sach-dat-ban', 'StoreController@bookTable')->name('bookTable');
        Route::post('/them-dat-ban', 'StoreController@createBookTable')->name('createBookTable');
        Route::post('/su-dung-ban', 'StoreController@usingTable')->name('usingTable');
        Route::post('/khach-den', 'StoreController@updateIsCome')->name('updateIsCome');
        Route::post('/thanh-toan', 'StoreController@paymentTable')->name('paymentTable');
        Route::get('/lich-su-dat-ban/{storeId}/{tableId}', 'StoreController@historyTable')->name('historyTable');
    });
});
