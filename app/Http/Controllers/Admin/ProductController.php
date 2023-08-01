<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductInterface;
use App\Repositories\Contracts\ProductCategoryInterface;
use App\DataTables\ProductDataTable;
use App\Http\Requests\Product\CreateProduct;
use App\Http\Requests\Product\UpdateProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    protected $productResponstory, $productCategoryResponstory;
    function __construct(ProductCategoryInterface $productCategoryResponstory,ProductInterface $productResponstory)
    {
        $this->middleware('auth');
        $this->productCategoryResponstory = $productCategoryResponstory;
        $this->productResponstory = $productResponstory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $dataTable)
    {
        $data = $this->productResponstory->getAll();
        $categories = $this->productCategoryResponstory->getAll();
        if ($categories->count() === 0){
            Session::flash('danger', 'Chưa có danh mục nào');
            return redirect()->route('admin.product-category.index');
        }
        return $dataTable->render('admin.product.index', compact('data', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->productCategoryResponstory->getAll();
        return view('admin.product.create', compact('categories'));
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
            $data['slug'] = $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-');
            if (!empty($data['image'])){
                $image_root = $data['image'];
                $data['image'] = urldecode($image_root);
            }
            $this->productResponstory->create($data);
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
        $categories = $this->productCategoryResponstory->getAll();
        $product = $this->productResponstory->getOneById($id);
        return view('admin.product.update', compact('product','categories'));
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
            $page = $this->productResponstory->getOneById($id);
            if (!empty($data['image']) && $data_root->image != $data['image']){
                $data['image'] = rawurldecode($data['image']);
            }
            if (!empty($data['slug'])){
                $data['slug'] = $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['title'], '-');
            }
            $page->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_product_success'));
            return redirect()->route('admin.product.edit', $id);
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
        $this->productResponstory->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_product_success')
        ];
    }
}
