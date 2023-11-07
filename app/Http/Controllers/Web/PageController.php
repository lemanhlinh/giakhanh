<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PagesTranslation;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PageController extends Controller
{
    public function index($slug){
        $lang = LaravelLocalization::getCurrentLocale();
        $page = PagesTranslation::select('id','title','content','page_id','image','image_title','description','seo_title','seo_description','seo_keyword')->where('slug', $slug)->where('lang',$lang)->first();
        if (!$page) {
            abort(404);
        }

        SEOTools::setTitle($page->seo_title?$page->seo_title:$page->title);
        SEOTools::setDescription($page->seo_description?$page->seo_description:$page->description);
        SEOTools::addImages($page->image?asset($page->image):null);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('launamgiakhanh.vn');
        SEOMeta::setKeywords($page->seo_keyword?$page->seo_keyword:$page->title);

        return view('web.page.home', compact('page'));
    }
}
