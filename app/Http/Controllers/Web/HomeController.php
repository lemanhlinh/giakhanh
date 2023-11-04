<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticlesTranslation;
use App\Models\Page;
use App\Models\PagesTranslation;
use App\Models\Product;
use App\Models\ProductsCategoriesTranslation;
use App\Models\ProductsTranslation;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ArticleInterface;
use App\Repositories\Contracts\SlideInterface;
use App\Repositories\Contracts\PageInterface;
use App\Repositories\Contracts\MediaImageInterface;
use App\Repositories\Contracts\MediaVideoInterface;
use App\Models\ProductsCategories;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HomeController extends Controller
{
    protected $articleRepository;

    public function __construct(
        ArticleInterface $articleRepository,
        SlideInterface $slideRepository,
        PageInterface $pageRepository,
        MediaImageInterface $mediaImageRepository,
        MediaVideoInterface $mediaVideoRepository
    )
    {
        $this->articleRepository = $articleRepository;
        $this->slideRepository = $slideRepository;
        $this->pageRepository = $pageRepository;
        $this->pageRepository = $pageRepository;
        $this->mediaImageRepository = $mediaImageRepository;
        $this->mediaVideoRepository = $mediaVideoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $slider = $this->slideRepository->getAll();
        $images = $this->mediaImageRepository->getList(['active' => 1,'is_home' => 1],['id','title','image'], 2,['mediaImages']);
        $videos = $this->mediaVideoRepository->getList(['active' => 1,'is_home' => 1],['id','title','image'], 2);
        $page = PagesTranslation::select('id','title','slug','description','image','page_id')->where(['active' => 1,'is_home' => 1,'lang'=>$lang])->first();
        $articles = ArticlesTranslation::select('id','title','slug','description','image','created_at','article_id')->where(['active' => 1,'lang'=>$lang])->limit(5)->get();
        $categories_product = ProductsCategoriesTranslation::where(['active' => 1,'lang'=>$lang])->get();
        $products = array();
        foreach ($categories_product as $cat){
            $products[$cat->id] = ProductsTranslation::select('id','slug','image','title','price','category_id','product_id')->where(['active' => 1, 'category_id' => $cat->id,'lang'=>$lang])->limit(3)->get();
        }
        return view('web.home',compact('articles','slider','page','images','videos','categories_product','products'));
    }

    /**
     * Show the form for getContent a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getContent()
    {
        return view('web.about');
    }

    /**
     * Show the form for getContentApp a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getContentApp()
    {
        return view('web.design');
    }
}
