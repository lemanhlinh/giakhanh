<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PagesTranslation;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PageController extends Controller
{
    public function index($slug){
        $lang = LaravelLocalization::getCurrentLocale();
        $page = PagesTranslation::select('id','content','image','image_title','description')->where('slug', $slug)->where('lang',$lang)->first();
        if (!$page) {
            abort(404);
        }
        return view('web.page.home', compact('page'));
    }
}
