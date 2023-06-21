<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductsCategories;
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
        return $dataTable->render('admin.product-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product-category.create');
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
            if (\request()->hasFile('image')) {
                $data['image'] = $this->productCategoryRepository->saveFileUpload($data['image'],'images');
            }
            $this->productCategoryRepository->create($data);
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
    public function edit(ProductsCategories $productsCategories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductsCategories  $productsCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductsCategories $productsCategories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductsCategories  $productsCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductsCategories $productsCategories)
    {
        //
    }
}
