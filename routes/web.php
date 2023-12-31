<?php
# @Author: Manh Linh
# @Date:   2023-01-01T17:33:09+07:00
# @Email:  lemanhlinh209@gmail.com
# @Last modified by:   Manh Linh
# @Last modified time: 2023-01-01T16:49:02+07:00
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/gioi-thieu', 'RedirectController@pageGioiThieu');
Route::get('/tin-tuc', 'RedirectController@catTinTuc');
Route::get('/uu-dai', 'RedirectController@catUuDai');
Route::get('/combo', 'RedirectController@catProductCombo');
Route::get('/khai-vi', 'RedirectController@catProductKhaiVi');
Route::get('/thit', 'RedirectController@catProductThit');
Route::get('/canh', 'RedirectController@catProductCanh');
Route::get('/nam', 'RedirectController@catProductNam');
Route::get('/nam-thien-nhien', 'RedirectController@catProductNamThienNhien');
Route::get('/cac-loai-rau', 'RedirectController@catProductCacLoaiRau');
Route::get('/lau-tai-nha', 'RedirectController@catProductLauTaiNha');
Route::get('/mon-theo-set', 'RedirectController@catProductMonTheoSet');

Route::group(['namespace' => 'Web', 'middleware' => [ 'localize','web' ], 'prefix' => LaravelLocalization::setLocale()], function (){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get(LaravelLocalization::transRoute('routes.page'), 'PageController@index')->name('page');
    Route::get(LaravelLocalization::transRoute('routes.article.cat'), 'ArticleController@cat')->name('catArticle');
    Route::get(LaravelLocalization::transRoute('routes.article.detail'), 'ArticleController@detail')->name('detailArticle');
    Route::get(LaravelLocalization::transRoute('routes.contact'), 'ContactController@index')->name('detailContact');
    Route::post('/lien-he', 'ContactController@store')->name('detailContactStore');
    Route::get(LaravelLocalization::transRoute('routes.album'), 'MediaController@album')->name('album');
    Route::get(LaravelLocalization::transRoute('routes.video'), 'MediaController@video')->name('video');
    Route::get(LaravelLocalization::transRoute('routes.store'), 'StoreController@index')->name('store');
    Route::get(LaravelLocalization::transRoute('routes.product.home'), 'ProductController@index')->name('productHome');
    Route::get(LaravelLocalization::transRoute('routes.product.cat'), 'ProductController@cat')->name('productCat');
    Route::get(LaravelLocalization::transRoute('routes.product.detail'), 'ProductController@detail')->name('productDetail');
    Route::post('/dat-ban', 'ProductController@bookTable')->name('bookTable');
    Route::post('/them-vao-gio-hang', 'ProductController@addToCart')->name('addToCart');
    Route::post('/update-gio-hang', 'ProductController@updateCart')->name('updateCart');
    Route::get(LaravelLocalization::transRoute('routes.cart.home'), 'ProductController@showCart')->name('showCart');
    Route::get(LaravelLocalization::transRoute('routes.cart.delete'), 'ProductController@removeItem')->name('removeItem');
    Route::post('/order', 'ProductController@order')->name('order');
    Route::get(LaravelLocalization::transRoute('routes.cart.success'), 'ProductController@success')->name('orderProductSuccess');
});

//Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
//    ->name('ckfinder_connector');
//
//Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
//    ->name('ckfinder_browser');

//Route::any('/ckfinder/examples/{example?}', '\CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
//    ->name('ckfinder_examples');

Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Auth::routes();
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/change-profile', 'UserController@getProfile')->name('getProfile');
    Route::post('/change-profile', 'UserController@changeProfile')->name('changeProfile');
    Route::get('/change-password', 'UserController@changePassword')->name('changePassword');
    Route::post('/update-password', 'UserController@updatePassword')->name('updatePassword');

    Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => ['permission:view_user']], function () {
        Route::get('', 'UserController@index')->name('index');
        Route::get('/create', 'UserController@create')->name('create')->middleware('permission:create_user');
        Route::post('/store', 'UserController@store')->name('store')->middleware('permission:create_user');
        Route::get('/edit/{id}', 'UserController@edit')->name('edit')->middleware('permission:edit_user');
        Route::post('/update/{id}', 'UserController@update')->name('update')->middleware('permission:edit_user');
        Route::post('/destroy/{id}', 'UserController@destroy')->name('destroy')->middleware('permission:delete_user');
    });

    Route::group(['prefix' => 'roles', 'as' => 'roles.', 'middleware' => ['can:view_role']], function () {
        Route::get('', 'RoleController@index')->name('index');
        Route::get('/create', 'RoleController@create')->name('create')->middleware('permission:create_role');
        Route::post('/store', 'RoleController@store')->name('store')->middleware('permission:create_role');
        Route::get('/edit/{id}', 'RoleController@edit')->name('edit')->middleware('permission:edit_role');
        Route::post('/update/{id}', 'RoleController@update')->name('update')->middleware('permission:edit_role');
        Route::post('/destroy/{id}', 'RoleController@destroy')->name('destroy')->middleware('permission:delete_role');
    });

    Route::group(['prefix' => 'setting', 'as' => 'setting.', 'middleware' => ['permission:view_setting']], function () {
        Route::get('', 'SettingController@index')->name('index');
        Route::get('/create', 'SettingController@create')->name('create')->middleware('permission:create_setting');
        Route::post('/store', 'SettingController@store')->name('store')->middleware('permission:create_setting');
        Route::get('/edit/{id}', 'SettingController@edit')->name('edit')->middleware('permission:edit_setting');
        Route::post('/update/{id}', 'SettingController@update')->name('update')->middleware('permission:edit_setting');
        Route::post('/destroy/{id}', 'SettingController@destroy')->name('destroy')->middleware('permission:delete_setting');
        Route::post('/change-active-setting/{id}', 'SettingController@changeActive')->name('changeActive')->middleware('permission:edit_setting');
    });

    Route::group(['prefix' => 'menu-category', 'as' => 'menu-category.', 'middleware' => ['permission:view_menu_categories']], function () {
        Route::get('', 'MenuCategoryController@index')->name('index');
        Route::get('/create', 'MenuCategoryController@create')->name('create')->middleware('permission:create_menu_categories');
        Route::post('/store', 'MenuCategoryController@store')->name('store')->middleware('permission:create_menu_categories');
        Route::get('/edit/{id}', 'MenuCategoryController@edit')->name('edit')->middleware('permission:edit_menu_categories');        Route::post('/update/{id}', 'MenuCategoryController@update')->name('update')->middleware('permission:edit_menu_categories');
        Route::post('/destroy/{id}', 'MenuCategoryController@destroy')->name('destroy')->middleware('permission:delete_menu_categories');
        Route::post('/update-tree', 'MenuCategoryController@updateTree')->name('updateTree')->middleware('permission:edit_menu_categories');
    });


    Route::group(['prefix' => 'menu', 'as' => 'menu.', 'middleware' => ['permission:view_menu']], function () {
        Route::get('', 'MenuController@index')->name('index');
//        Route::get('/create', 'MenuController@create')->name('create')->middleware('permission:create_menu');
        Route::post('/store', 'MenuController@store')->name('store')->middleware('permission:create_menu');
//        Route::get('/edit/{id}', 'MenuController@edit')->name('edit')->middleware('permission:edit_menu');
        Route::post('/update/{id}', 'MenuController@update')->name('update')->middleware('permission:edit_menu');
        Route::post('/destroy/{id}', 'MenuController@destroy')->name('destroy')->middleware('permission:delete_menu');
        Route::post('/update-tree', 'MenuController@updateTree')->name('updateTree')->middleware('permission:edit_menu');
    });

    Route::group(['prefix' => 'page', 'as' => 'page.', 'middleware' => ['permission:view_page']], function () {
        Route::get('', 'PageController@index')->name('index');
        Route::get('/create', 'PageController@create')->name('create')->middleware('permission:create_page');
        Route::post('/store', 'PageController@store')->name('store')->middleware('permission:create_page');
        Route::get('/edit/{id}', 'PageController@edit')->name('edit')->middleware('permission:edit_page');
        Route::post('/update/{id}', 'PageController@update')->name('update')->middleware('permission:edit_page');
        Route::post('/destroy/{id}', 'PageController@destroy')->name('destroy')->middleware('permission:delete_page');
        Route::post('/change-active-page/{id}', 'PageController@changeActive')->name('changeActive')->middleware('permission:edit_page');
    });

    Route::group(['prefix' => 'contact', 'as' => 'contact.', 'middleware' => ['permission:view_contact']], function () {
        Route::get('', 'ContactController@index')->name('index');
    });

    Route::group(['prefix' => 'article-category', 'as' => 'article-category.', 'middleware' => ['permission:view_article_categories']], function () {
        Route::get('', 'ArticlesCategoriesController@index')->name('index');
        Route::get('/create', 'ArticlesCategoriesController@create')->name('create')->middleware('permission:create_article_categories');
        Route::post('/store', 'ArticlesCategoriesController@store')->name('store')->middleware('permission:create_article_categories');
        Route::get('/edit/{id}', 'ArticlesCategoriesController@edit')->name('edit')->middleware('permission:edit_article_categories');
        Route::post('/update/{id}', 'ArticlesCategoriesController@update')->name('update')->middleware('permission:edit_article_categories');
        Route::post('/destroy/{id}', 'ArticlesCategoriesController@destroy')->name('destroy')->middleware('permission:delete_article_categories');
        Route::post('/change-active-article-cat/{id}', 'ArticlesCategoriesController@changeActive')->name('changeActive')->middleware('permission:edit_article_categories');
    });

    Route::group(['prefix' => 'articles', 'as' => 'article.', 'middleware' => ['permission:view_article']], function () {
        Route::get('', 'ArticleController@index')->name('index');
        Route::get('/create', 'ArticleController@create')->name('create')->middleware('permission:create_article');
        Route::post('/store', 'ArticleController@store')->name('store')->middleware('permission:create_article');
        Route::get('/edit/{id}', 'ArticleController@edit')->name('edit')->middleware('permission:edit_article');
        Route::post('/update/{id}', 'ArticleController@update')->name('update')->middleware('permission:edit_article');
        Route::post('/destroy/{id}', 'ArticleController@destroy')->name('destroy')->middleware('permission:delete_article');
        Route::post('/change-active-article/{id}', 'ArticleController@changeActive')->name('changeActive')->middleware('permission:edit_article');
        Route::post('/change-home-article/{id}', 'ArticleController@changeHome')->name('changeHome')->middleware('permission:edit_article');
    });

    Route::group(['prefix' => 'product-category', 'as' => 'product-category.', 'middleware' => ['permission:view_product_categories']], function () {
        Route::get('', 'ProductsCategoriesController@index')->name('index');
        Route::get('/create', 'ProductsCategoriesController@create')->name('create')->middleware('permission:create_product_categories');
        Route::post('/store', 'ProductsCategoriesController@store')->name('store')->middleware('permission:create_product_categories');
        Route::get('/edit/{id}', 'ProductsCategoriesController@edit')->name('edit')->middleware('permission:edit_product_categories');
        Route::post('/update/{id}', 'ProductsCategoriesController@update')->name('update')->middleware('permission:edit_product_categories');
        Route::post('/destroy/{id}', 'ProductsCategoriesController@destroy')->name('destroy')->middleware('permission:delete_product_categories');
        Route::post('/change-active-article-cat/{id}', 'ProductsCategoriesController@changeActive')->name('changeActive')->middleware('permission:edit_product_categories');
    });

    Route::group(['prefix' => 'product', 'as' => 'product.', 'middleware' => ['permission:view_product']], function () {
        Route::get('', 'ProductController@index')->name('index');
        Route::get('/create', 'ProductController@create')->name('create')->middleware('permission:create_product');
        Route::post('/store', 'ProductController@store')->name('store')->middleware('permission:create_product');
        Route::get('/edit/{id}', 'ProductController@edit')->name('edit')->middleware('permission:edit_product');
        Route::post('/update/{id}', 'ProductController@update')->name('update')->middleware('permission:edit_product');
        Route::post('/destroy/{id}', 'ProductController@destroy')->name('destroy')->middleware('permission:delete_product');
        Route::post('/change-active-product/{id}', 'ProductController@changeActive')->name('changeActive')->middleware('permission:edit_product');
        Route::post('/change-home-product/{id}', 'ProductController@changeHome')->name('changeHome')->middleware('permission:edit_product');
    });

    Route::group(['prefix' => 'book-table', 'as' => 'book-table.', 'middleware' => ['permission:view_book_table']], function () {
        Route::get('', 'BookTableController@index')->name('index');
        Route::get('/create', 'BookTableController@create')->name('create')->middleware('permission:create_book_table');
        Route::post('/store', 'BookTableController@store')->name('store')->middleware('permission:create_book_table');
        Route::get('/edit/{id}', 'BookTableController@edit')->name('edit')->middleware('permission:edit_book_table');
        Route::post('/update/{id}', 'BookTableController@update')->name('update')->middleware('permission:edit_book_table');
        Route::post('/destroy/{id}', 'BookTableController@destroy')->name('destroy')->middleware('permission:delete_book_table');
        Route::post('/load-floor', 'BookTableController@loadFloor')->name('loadFloor')->middleware('permission:edit_book_table');
        Route::post('/load-desk', 'BookTableController@loadDesk')->name('loadDesk')->middleware('permission:edit_book_table');
    });

    Route::group(['prefix' => 'media-image', 'as' => 'media-image.', 'middleware' => ['permission:view_media_image']], function () {
        Route::get('', 'MediaController@index')->name('index');
        Route::get('/create', 'MediaController@create')->name('create')->middleware('permission:create_media_image');
        Route::post('/store', 'MediaController@store')->name('store')->middleware('permission:create_media_image');
        Route::get('/edit/{id}', 'MediaController@edit')->name('edit')->middleware('permission:edit_media_image');
        Route::post('/update/{id}', 'MediaController@update')->name('update')->middleware('permission:edit_media_image');
        Route::post('/destroy/{id}', 'MediaController@destroy')->name('destroy')->middleware('permission:delete_media_image');
        Route::post('/change-active-image/{id}', 'MediaController@changeActive')->name('changeActive')->middleware('permission:edit_media_image');
    });

    Route::group(['prefix' => 'media-video', 'as' => 'media-video.', 'middleware' => ['permission:view_media_video']], function () {
        Route::get('', 'MediaController@indexVideo')->name('index');
        Route::get('/create', 'MediaController@createVideo')->name('create')->middleware('permission:create_media_video');
        Route::post('/store', 'MediaController@storeVideo')->name('store')->middleware('permission:create_media_video');
        Route::get('/edit/{id}', 'MediaController@editVideo')->name('edit')->middleware('permission:edit_media_video');
        Route::post('/update/{id}', 'MediaController@updateVideo')->name('update')->middleware('permission:edit_media_video');
        Route::post('/destroy/{id}', 'MediaController@destroyVideo')->name('destroy')->middleware('permission:delete_media_video');
        Route::post('/change-active-image/{id}', 'MediaController@changeActive')->name('changeActive')->middleware('permission:edit_media_video');
    });


    Route::group(['prefix' => 'order-product', 'as' => 'order-product.', 'middleware' => ['permission:view_product_orders']], function () {
        Route::get('', 'OrderController@index')->name('index');
        Route::get('/create', 'OrderController@create')->name('create')->middleware('permission:create_product_orders');
        Route::post('/store', 'OrderController@store')->name('store')->middleware('permission:create_product_orders');
        Route::get('/edit/{id}', 'OrderController@edit')->name('edit')->middleware('permission:edit_product_orders');
        Route::post('/update/{id}', 'OrderController@update')->name('update')->middleware('permission:edit_product_orders');
        Route::post('/destroy/{id}', 'OrderController@destroy')->name('destroy')->middleware('permission:delete_product_orders');
    });

    Route::group(['prefix' => 'slider', 'as' => 'slider.', 'middleware' => ['permission:view_slider']], function () {
        Route::get('', 'SliderController@index')->name('index');
        Route::get('/create', 'SliderController@create')->name('create')->middleware('permission:create_slider');
        Route::post('/store', 'SliderController@store')->name('store')->middleware('permission:create_slider');
        Route::get('/edit/{id}', 'SliderController@edit')->name('edit')->middleware('permission:edit_slider');
        Route::post('/update/{id}', 'SliderController@update')->name('update')->middleware('permission:edit_slider');
        Route::post('/destroy/{id}', 'SliderController@destroy')->name('destroy')->middleware('permission:delete_slider');
        Route::post('/change-active-slide/{id}', 'SliderController@changeActive')->name('changeActive')->middleware('permission:edit_slider');
    });

    Route::group(['prefix' => 'store', 'as' => 'store.', 'middleware' => ['permission:view_store']], function () {
        Route::get('', 'StoreController@index')->name('index');
        Route::get('/create', 'StoreController@create')->name('create')->middleware('permission:create_store');
        Route::post('/store', 'StoreController@store')->name('store')->middleware('permission:create_store');
        Route::get('/edit/{id}', 'StoreController@edit')->name('edit')->middleware('permission:edit_store');
        Route::post('/update/{id}', 'StoreController@update')->name('update')->middleware('permission:edit_store');
        Route::post('/destroy/{id}', 'StoreController@destroy')->name('destroy')->middleware('permission:delete_store');
        Route::post('/change-active-store/{id}', 'StoreController@changeActive')->name('changeActive')->middleware('permission:edit_store');
        Route::get('/show-floor/{id}', 'StoreController@showFloor')->name('showFloor')->middleware('permission:view_store_floor');
    });

    Route::group(['prefix' => 'store-floor', 'as' => 'store-floor.', 'middleware' => ['permission:view_store_floor']], function () {
        Route::get('/create', 'StoreFloorController@create')->name('create')->middleware('permission:create_store_floor');
        Route::post('/store', 'StoreFloorController@store')->name('store')->middleware('permission:create_store_floor');
        Route::get('/edit/{id}', 'StoreFloorController@edit')->name('edit')->middleware('permission:edit_store_floor');
        Route::post('/update/{id}', 'StoreFloorController@update')->name('update')->middleware('permission:edit_store_floor');
        Route::post('/destroy/{id}', 'StoreFloorController@destroy')->name('destroy')->middleware('permission:delete_store_floor');
        Route::post('/change-active-store-floor/{id}', 'StoreFloorController@changeActive')->name('changeActive')->middleware('permission:edit_store_floor');
        Route::get('/show-desk/{storeId}/{deskId}', 'StoreFloorController@showDesk')->name('showDesk')->middleware('permission:view_store_floor_desk');
    });

    Route::group(['prefix' => 'store-floor-desk', 'as' => 'store-floor-desk.', 'middleware' => ['permission:view_store_floor_desk']], function () {
        Route::get('/create', 'StoreFloorDeskController@create')->name('create')->middleware('permission:create_store_floor_desk');
        Route::post('/store', 'StoreFloorDeskController@store')->name('store')->middleware('permission:create_store_floor_desk');
        Route::get('/edit/{id}', 'StoreFloorDeskController@edit')->name('edit')->middleware('permission:edit_store_floor_desk');
        Route::post('/update/{id}', 'StoreFloorDeskController@update')->name('update')->middleware('permission:edit_store_floor_desk');
        Route::post('/destroy/{id}', 'StoreFloorDeskController@destroy')->name('destroy')->middleware('permission:delete_store_floor_desk');
        Route::post('/change-active-store-floor-desk/{id}', 'StoreFloorDeskController@changeActive')->name('changeActive')->middleware('permission:edit_store_floor_desk');
    });

    Route::group(['prefix' => 'store-user', 'as' => 'store-user.', 'middleware' => ['permission:view_store_user']], function () {
        Route::get('', 'StoreUserController@index')->name('index');
        Route::get('/create', 'StoreUserController@create')->name('create')->middleware('permission:create_store_user');
        Route::post('/store', 'StoreUserController@store')->name('store')->middleware('permission:create_store_user');
        Route::get('/edit/{id}', 'StoreUserController@edit')->name('edit')->middleware('permission:edit_store_user');
        Route::post('/update/{id}', 'StoreUserController@update')->name('update')->middleware('permission:edit_store_user');
        Route::post('/destroy/{id}', 'StoreUserController@destroy')->name('destroy')->middleware('permission:delete_store_user');
        Route::post('/change-active-store/{id}', 'StoreUserController@changeActive')->name('changeActive')->middleware('permission:edit_store_user');
    });
});


