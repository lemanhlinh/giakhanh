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
        Route::get('/danh-sach-mon/{storeId}/{tableId}', 'StoreController@listFood')->name('listFood');
    });
});
