<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductsCategories;
use App\Models\ProductsCategoriesTranslation;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductCategoryInterface;
use App\Repositories\Contracts\ProductInterface;
use App\DataTables\ProductCategoryDataTable;
use App\Http\Requests\Product\CreateCategoryProduct;
use App\Http\Requests\Product\UpdateCategoryProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductsCategoriesController extends Controller
{

    protected $productCategoryRepository,$productRepository;

    public function __construct(ProductCategoryInterface $productCategoryRepository,ProductInterface $productRepository )
    {
        $this->middleware('auth');
        $this->productCategoryRepository = $productCategoryRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductCategoryDataTable $dataTable)
    {
        $local = request()->query('local','vi');
        return $dataTable->render('admin.product-category.index',compact('local'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $local = request()->query('local','vi');
        return view('admin.product-category.create',compact('local'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateCategoryProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryProduct $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $data['slug'] = $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-');
            if (!empty($data['image'])){
                $image_root = $data['image'];
                $data['image'] = urldecode($image_root);
            }
            $cat = $this->productCategoryRepository->create($data);
            $local = request()->input('locale','vi');
            foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
                $langTranslation = new ProductsCategoriesTranslation([
                    'lang' => $localeCode,
                    'title' => $localeCode == $local ? $data['title']:'',
                    'image' => $localeCode == $local ? $data['image']:'',
                    'slug' => $localeCode == $local ? $data['slug']:'',
                    'ordering' => $localeCode == $local ? $data['ordering']:0,
                    'active' => $localeCode == $local ? $data['active']:0,
                    'seo_title' => $localeCode == $local ? $data['seo_title']:'',
                    'seo_keyword' => $localeCode == $local ? $data['seo_keyword']:'',
                    'seo_description' => $localeCode == $local ? $data['seo_description']:''
                ]);
                $cat->translations()->save($langTranslation);
            }
            DB::commit();
            Session::flash('success', trans('message.create_product_category_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_product_category_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductsCategories  $productsCategories
     * @return \Illuminate\Http\Response
     */
    public function show(ProductsCategories $productsCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductsCategories  $productsCategories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $local = request()->query('local','vi');
        $product_category = $this->productCategoryRepository->getOneById($id,['translations' => function($query) use ($local){
            $query->where(['lang'=> $local ]);
        }]);
        return view('admin.product-category.update', compact('product_category','local'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductsCategories  $productsCategories
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateCategoryProduct $req)
    {
        $data_root = $this->productCategoryRepository->getOneById($id);
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $product_cat = $this->productCategoryRepository->getOneById($id);
            if (!empty($data['image']) && $data_root->image != $data['image']){
                $data['image'] = rawurldecode($data['image']);
            }
            if (empty($data['slug'])){
                $data['slug'] = $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-');
            }
            $product_cat->update($data);
            $local = request()->input('locale','vi');
            $product_cat->translations->where(['product_category_id'=> $id,'lang' =>$local])->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_product_category_success'));
            return redirect()->back();
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_product_category_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductsCategories  $productsCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productCategoryRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_product_category_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $product_category = ProductsCategoriesTranslation::findOrFail($id);
        $product_category->update(['active' => !$product_category->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_product_category_success')
        ];
    }
}
