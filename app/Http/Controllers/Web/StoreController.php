<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\City;

class StoreController extends Controller
{
    public function index(){
        $stores = Store::where(['active' => 1])->get();
        $cities = City::has('store')->get();

        $logo = Setting::where('key', 'logo')->first();

        SEOTools::setTitle('Hệ thống - Lẩu nấm gia khánh');
        SEOTools::setDescription('Với tiêu chí đó mỗi sản phẩm của Lẩu Nấm Gia Khánh đều được qua sàng lọc, chắt chiu, tinh khiết và quý báu nhất từ thiên nhiên. Nhằm mang đến cho thực khách những món ăn có giá trị về chất lượng và luôn lấy tiêu chí “ sức khỏe con người làm trung […]');
        SEOMeta::setKeywords('Lẩu nấm gia khánh, lẩu nấm');
        SEOTools::addImages(asset($logo->value));
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('launamgiakhanh.vn');

        return view('web.store.home', compact('stores','cities'));
    }
}
