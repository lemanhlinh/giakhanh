<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ArticleDataTable;
use App\DataTables\Scopes\ArticleDataTableScope;
use App\Repositories\Contracts\ArticleCategoryInterface;
use App\Repositories\Contracts\ArticleInterface;
use App\Http\Requests\Article\CreateArticle;
use App\Http\Requests\Article\UpdateArticle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    protected $articleCategoryRepository;
    protected $articleRepository;

    public function __construct(ArticleCategoryInterface $articleCategoryRepository, ArticleInterface $articleRepository)
    {
        $this->middleware('auth');
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ArticleDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(ArticleDataTable $dataTable)
    {
        $data = request()->all();
        $categories = $this->articleCategoryRepository->getAll();
        if (!empty($categories)){
            Session::flash('danger', 'Chưa có danh mục nào');
            return redirect()->route('admin.article-category.index');
        }
        return $dataTable->addScope(new ArticleDataTableScope())->render('admin.article.index', compact('data','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesTree = $this->articleCategoryRepository->getWithDepth();
        $categories = array();
        foreach ($categoriesTree as $item) {
            $categories[$item->id] = str_repeat('-', $item->depth) . $item->name;
        }
        return view('admin.article.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateArticle $req
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticle $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $this->articleRepository->store([
                'title' => $data['title'],
                'slug' => $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-'),
                'category_id' => $req->input('category_id'),
                'description' => $data['description'],
                'content' => $req->input('content'),
                'date' => $data['date'],
                'status' => intval($data['status']),
                'image' =>  $data['image'],
                'seo_title' => $req->input('seo_title'),
                'seo_keyword' => $req->input('seo_keyword'),
                'seo_description' => $req->input('seo_description')
            ]);
            DB::commit();
            Session::flash('success', trans('message.create_article_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_article_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->articleRepository->getOneById($id);
        $categoriesTree = $this->articleCategoryRepository->getWithDepth();
        $categories = array();
        foreach ($categoriesTree as $item) {
            $categories[$item->id] = str_repeat('-', $item->depth) . $item->name;
        }
        return view('admin.article.update', compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateArticle  $req
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateArticle $req)
    {
        try {
            $data = $req->validated();

            $article = $this->articleRepository->getOneById($id);

            $article->title = $data['title'];
            $article->slug = $data['slug'];
            $article->description = $data['description'];
            $article->category_id = $req->input('category_id');
            $article->content = $req->input('content');
            $article->date = $data['date'];
            $article->status = intval($data['status']);
            $article->seo_title = $req->input('seo_title');
            $article->seo_keyword = $req->input('seo_keyword');
            $article->seo_description = $req->input('seo_description');
            if (\request()->hasFile('image')) {
                $article->image = $this->articleCategoryRepository->saveFileUpload($data['image'],'images');
            }

            $article->save();
            Session::flash('success', trans('message.update_article_success'));
            return redirect()->route('admin.article.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_article_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
