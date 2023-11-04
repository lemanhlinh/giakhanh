<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticlesCategories;
use App\Models\ArticlesTranslation;
use Illuminate\Http\Request;
use App\DataTables\ArticleDataTable;
use App\DataTables\Scopes\ArticleDataTableScope;
use App\Repositories\Contracts\ArticleCategoryInterface;
use App\Repositories\Contracts\ArticleInterface;
use App\Http\Requests\Article\CreateArticle;
use App\Http\Requests\Article\UpdateArticle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    protected $articleCategoryRepository;
    protected $articleRepository;
    protected $resizeImage;

    public function __construct(ArticleCategoryInterface $articleCategoryRepository, ArticleInterface $articleRepository)
    {
        $this->middleware('auth');
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->articleRepository = $articleRepository;
        $this->resizeImage = $this->articleRepository->resizeImage();
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
        if ($categories->count() === 0){
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
        $local = request()->query('local','vi');
        $categories = $this->articleCategoryRepository->getAll();
        return view('admin.article.create',compact('categories','local'));
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
            $image_root = '';
            $data['slug'] = $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-');
            if (!empty($data['image'])){
                $image_root = $data['image'];
                $data['image'] = urldecode($image_root);
            }
            $category = $this->articleCategoryRepository->getOneById($data['category_id']);
            $data['type'] = $category->type;
            $model = $this->articleRepository->create($data);
            if (!empty($data['image'])){
                $this->articleRepository->saveFileUpload($image_root,$this->resizeImage,$model->id,'article');
            }
            $local = request()->input('locale','vi');
            foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
                $langTranslation = new ArticlesTranslation([
                    'lang' => $localeCode,
                    'title' => $localeCode == $local ? $data['title']:'',
                    'image' => $localeCode == $local ? $data['image']:'',
                    'slug' => $localeCode == $local ? $data['slug']:'',
                    'category_id' => $data['category_id'],
                    'content' => $localeCode == $local ? $data['content']:'',
                    'description' => $localeCode == $local ? $data['description']:'',
                    'type' => $data['type'],
                    'active' => $localeCode == $local ? $data['active']:0,
                    'is_home' => $localeCode == $local ? $data['is_home']:0,
                    'ordering' => $localeCode == $local ? $data['ordering']:0,
                    'seo_title' => $localeCode == $local ? $data['seo_title']:'',
                    'seo_keyword' => $localeCode == $local ? $data['seo_keyword']:'',
                    'seo_description' => $localeCode == $local ? $data['seo_description']:''
                ]);
                $model->translations()->save($langTranslation);
            }
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
        $local = request()->query('local','vi');
        $article = $this->articleRepository->getOneById($id,['translations' => function($query) use ($local){
            $query->where(['lang'=> $local ]);
        }]);
        $categories = ArticlesCategories::with(['translations' => function($query) use ($local){
            $query->where(['lang'=> $local ]);
        }])->get();
        return view('admin.article.update', compact('article','categories','local'));
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
        $data_root = $this->articleRepository->getOneById($id);
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $article = $this->articleRepository->getOneById($id);
            if (!empty($data['image']) && $data_root->image != $data['image']){
                $this->articleRepository->removeImageResize($data_root->image,$this->resizeImage, $id,'article');
                $data['image'] = $this->articleRepository->saveFileUpload($data['image'],$this->resizeImage, $id,'article');
            }
            if (empty($data['slug'])){
                $data['slug'] = $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-');
            }
            $category = $this->articleCategoryRepository->getOneById($data['category_id']);
            $data['type'] = $category->type;
            $article->update($data);
            $local = request()->input('locale','vi');
            $article->translations->where(['article_id'=> $id,'lang' => $local])->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_article_success'));
            return redirect()->back();
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
        $data = $this->articleRepository->getOneById($id);

        // Đường dẫn tới tệp tin
        $resize = $this->resizeImage;
        $img_path = pathinfo($data->image, PATHINFO_DIRNAME);
        foreach ($resize as $item){
            $array_resize_ = str_replace($img_path.'/','/public/article/'.$item[0].'x'.$item[1].'/'.$data->id.'-',$data->image);
            $array_resize_ = str_replace(['.jpg', '.png','.bmp','.gif','.jpeg'],'.webp',$array_resize_);
            Storage::delete($array_resize_);
        }

        $this->articleRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_article_success')
        ];
    }
}
