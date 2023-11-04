<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\SettingInterface;
use App\Repositories\Contracts\MenuInterface;
use App\Repositories\Contracts\StoreInterface;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(SettingInterface $settingRepository,MenuInterface $menuRepository, StoreInterface $storeRepository)
    {
        $menu = null;
        $setting = null;
        $stores = null;

        $url = Request::url();
        $path = parse_url($url, PHP_URL_PATH);
        $segments = array_filter(explode('/', $path));
        $language = reset($segments);

        if (!Request::is('admin/*')) {
            if (Schema::hasTable('setting')) {
                $setting = $settingRepository->getAll()->pluck('value', 'key');
            }
            if (Schema::hasTable('menu')) {
                $menu =  Menu::where(['category_id'=>1])->with(['translations' => function($query) use ($language){
                    $query->where(['lang'=> $language ]);
                }])->withDepth()->defaultOrder()->get()->toTree();
            }
            if (Schema::hasTable('stores')) {
                $stores = $storeRepository->getList(['active' => 1],['id','title']);
            }
//            View::composer(['web.partials._header', 'web.partials._footer'], function ($view) {
//                $config = Setting::all();
//                $view->with('menus', $config);
//            });
        }
        View::share('setting', $setting);
        View::share('stores', $stores);
        View::composer(['web.partials._header', 'web.partials._footer','web.layouts.web'], function ($view) use ($menu) {
            $view->with('menus', $menu);
        });

    }
}
