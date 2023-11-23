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
Route::group(['namespace' => 'Api'], function (){
    Route::get('/danh-sach-cua-hang', 'StoreController@listStore')->name('listStore');
    Route::get('/danh-sach-ban', 'StoreController@listTable')->name('listTable');
    Route::get('/danh-sach-mon', 'StoreController@listFood')->name('listFood');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
