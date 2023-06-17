<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ArticleInterface;

class HomeController extends Controller
{
    protected $articleRepository;

    public function __construct(ArticleInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleRepository->getAll();
        return view('web.home',compact('articles'));
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
