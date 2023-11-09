<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticlesCategoriesTranslation;
use App\Models\ArticlesTranslation;
use App\Models\Setting;
use App\Repositories\Contracts\ArticleCategoryInterface;
use App\Repositories\Contracts\ArticleInterface;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use App\Models\ArticlesCategories;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ArticleController extends Controller
{
    protected $articleCategoryRepository;
    protected $articleRepository;

    public function __construct(ArticleCategoryInterface $articleCategoryRepository, ArticleInterface $articleRepository)
    {
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cat($slug)
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $category = ArticlesCategoriesTranslation::where(['slug'=> $slug,'active'=> 1,'lang'=>$lang])
            ->select('id','title','type','seo_title','seo_keyword','seo_description')
            ->first();
        if (!$category) {
            abort(404);
        }
        SEOTools::setTitle($category->seo_title?$category->seo_title:$category->title);
        SEOTools::setDescription($category->seo_description?$category->seo_description:$category->description);
        SEOTools::addImages($category->image?asset($category->image):null);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('launamgiakhanh.vn');
        SEOMeta::setKeywords($category->seo_keyword?$category->seo_keyword:$category->title);

        if ($category->type == 1){
            $articles = ArticlesTranslation::select('id','article_id','slug','image','description','title','active','category_id','created_at')->where(['active'=>1,'category_id'=>$category->id,'lang'=>$lang])->latest()->paginate(9);
            return view('web.article.promotion',compact('category','articles'));
        }else{
            $articles = ArticlesTranslation::select('id','article_id','slug','image','description','title','active','category_id','created_at')->where(['active'=>1,'category_id'=>$category->id,'lang'=>$lang])->latest()->paginate(10);
            return view('web.article.home',compact('category','articles'));
        }

    }

    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($slug)
    {
        $lang = LaravelLocalization::getCurrentLocale();
        $article = ArticlesTranslation::where(['slug' => $slug,'active'=>1,'lang'=>$lang])->with('category')->first();
        if ($article->type == 0){
            $limit = 4;
        }else{
            $limit = 3;
        }
        $articles = ArticlesTranslation::select('id','article_id','slug','image','description','title','active','category_id','created_at')
            ->where(['category_id' => $article->category_id,'active' => 1,'lang'=>$lang])->limit($limit)->get();

        SEOTools::setTitle($article->seo_title?$article->seo_title:$article->title);
        SEOTools::setDescription($article->seo_description?$article->seo_description:$article->description);
        SEOTools::addImages($article->image?asset($article->image):null);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('launamgiakhanh.vn');
        SEOMeta::setKeywords($article->seo_keyword?$article->seo_keyword:$article->title);

        return view('web.article.detail', compact('article','articles'));
    }
}
