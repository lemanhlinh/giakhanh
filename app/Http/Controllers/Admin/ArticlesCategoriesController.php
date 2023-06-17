<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ArticleCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\ArticlesCategories;
use App\Repositories\Contracts\ArticleCategoryInterface;
use App\Http\Requests\Article\CreateArticleCategory;
use App\Http\Requests\Article\UpdateArticleCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ArticlesCategoriesController extends Controller
{

    protected $articleCategoryRepository;

    public function __construct(ArticleCategoryInterface $articleCategoryRepository)
    {
        $this->middleware('auth');
        $this->articleCategoryRepository = $articleCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ArticleCategoryDataTable $dataTable)
    {
        $categories = $this->articleCategoryRepository->getAll();
        return $dataTable->render('admin.article-category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateArticleCategory $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $data['slug'] = $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-');
            $this->articleCategoryRepository->create($data);
            DB::commit();
            Session::flash('success', trans('message.create_article_category_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_article_category_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArticlesCategories  $articlesCategories
     * @return \Illuminate\Http\Response
     */
    public function show(ArticlesCategories $articlesCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArticlesCategories  $articlesCategories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article_category = $this->articleCategoryRepository->getOneById($id);
        return view('admin.article-category.update',compact('article_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArticlesCategories  $articlesCategories
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateArticleCategory $req)
    {
        try {
            $data = $req->validated();
            $article_category = $this->articleCategoryRepository->getOneById($id);

            $image = null;
            if (\request()->hasFile('value')) {
                $image = $this->articleCategoryRepository->saveFileUpload($data['value'],'images');
            }

            $article_category->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_article_category_success'));
            return redirect()->route('admin.article-category.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_article_category_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArticlesCategories  $articlesCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticlesCategories $articlesCategories)
    {
        //
    }
}
