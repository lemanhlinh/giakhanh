<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\MenuTranslation;
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

        $language = \LaravelLocalization::getCurrentLocale();

        if (!Request::is('admin/*')) {
            if (Schema::hasTable('setting')) {
                if ($language == 'vi' || $language == null){
                    $setting = $settingRepository->getAll()->pluck('value', 'key');
                }else{
                    $setting = $settingRepository->getAll()->pluck('value_en', 'key');
                }

            }
            if (Schema::hasTable('menu')) {
                $menu = MenuTranslation::where(['category_id'=>1,'lang'=> $language?$language:'vi'])->withDepth()->defaultOrder()->get()->toTree();
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
