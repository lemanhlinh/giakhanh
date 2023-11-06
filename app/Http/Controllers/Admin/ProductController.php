<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Scopes\ProductDataTableScope;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductsCategories;
use App\Models\ProductsTranslation;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductInterface;
use App\Repositories\Contracts\ProductCategoryInterface;
use App\DataTables\ProductDataTable;
use App\Http\Requests\Product\CreateProduct;
use App\Http\Requests\Product\UpdateProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    protected $productResponstory, $productCategoryResponstory;
    protected $resizeImage;

    function __construct(ProductCategoryInterface $productCategoryResponstory,ProductInterface $productResponstory)
    {
        $this->middleware('auth');
        $this->productCategoryResponstory = $productCategoryResponstory;
        $this->productResponstory = $productResponstory;
        $this->resizeImage = $this->productResponstory->resizeImage();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $dataTable)
    {
        $data = request()->all();
        $local = request()->query('local','vi');
        $categories = $this->productCategoryResponstory->getAll();
        if ($categories->count() === 0){
            Session::flash('danger', 'Chưa có danh mục nào');
            return redirect()->route('admin.product-category.index');
        }
        return $dataTable->addScope(new ProductDataTableScope())->render('admin.product.index', compact('data', 'categories','local'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $local = request()->query('local','vi');
        $categories = $this->productCategoryResponstory->getAll();
        return view('admin.product.create', compact('categories','local'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProduct $req)
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
            $local = request()->input('locale','vi');
            $model = $this->productResponstory->create($data);
            if (!empty($data['image'])){
                $this->productResponstory->saveFileUpload($image_root,$this->resizeImage,$model->id,'product',$local);
            }

            foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
                $langTranslation = new ProductsTranslation([
                    'lang' => $localeCode,
                    'title' => $localeCode == $local ? $data['title']:'',
                    'image' => $localeCode == $local ? $data['image']:'',
                    'slug' => $localeCode == $local ? $data['slug']:'',
                    'category_id' => $data['category_id'],
                    'content_include' => $localeCode == $local ? $data['content_include']:'',
                    'price' => $localeCode == $local ? $data['price']:0,
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
            Session::flash('success', trans('message.create_product_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_product_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $local = request()->query('local','vi');
        $categories = ProductsCategories::with(['translations' => function($query) use ($local){
            $query->where(['lang'=> $local ]);
        }])->get();
        $product = $this->productResponstory->getOneById($id,['translations' => function($query) use ($local){
            $query->where(['lang'=> $local ]);
        }]);
        return view('admin.product.update', compact('product','categories','local'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateProduct $req)
    {
        $data_root = $this->productResponstory->getOneById($id);
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $product = $this->productResponstory->getOneById($id);
            $local = request()->input('locale','vi');
            if (!empty($data['image']) && $data_root->image != $data['image']){
                if ($data_root->image){
                    $this->productResponstory->removeImageResize($data_root->image,$this->resizeImage, $id,'product',$local);
                }
                $data['image'] = $this->productResponstory->saveFileUpload($data['image'],$this->resizeImage, $id,'product',$local);
            }
            if (empty($data['slug'])){
                $data['slug'] = $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-');
            }
            $product->update($data);

            $product->translations->where(['product_id'=> $id,'lang' => $local])->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_product_success'));
            return redirect()->back();
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_product_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = $this->productResponstory->getOneById($id);
        $local = request()->input('locale','vi');
        // Đường dẫn tới tệp tin
        $resize = $this->resizeImage;
        $img_path = pathinfo($data->image, PATHINFO_DIRNAME);
        foreach ($resize as $item){
            $array_resize_ = str_replace($img_path.'/','/public/product/'.$local.'/'.$item[0].'x'.$item[1].'/'.$data->id.'-',$data->image);
            $array_resize_ = str_replace(['.jpg', '.png','.bmp','.gif','.jpeg'],'.webp',$array_resize_);
            Storage::delete($array_resize_);
        }

        $this->productResponstory->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_product_success')
        ];
    }
}
