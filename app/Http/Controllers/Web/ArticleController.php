<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ArticleCategoryInterface;
use App\Repositories\Contracts\ArticleInterface;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleCategoryRepository;
    protected $articleRepository;

    public function __construct(ArticleCategoryInterface $articleCategoryRepository, ArticleInterface $articleRepository)
    {
//        $this->middleware('auth');
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->articleRepository = $articleRepository;
    }
    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = $this->articleRepository->getAll();
        return view('web.article.home', compact('article'));
    }

    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cat()
    {
        return view('web.home');
    }

    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($slug, $id)
    {
        $articles = $this->articleRepository->getAll();
        $article = $this->articleRepository->getOneById($id);
        return view('web.article.detail', compact('article','articles'));
    }
}
