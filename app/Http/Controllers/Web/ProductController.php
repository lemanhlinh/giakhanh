<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductCategoryInterface;
use App\Repositories\Contracts\ProductInterface;

class ProductController extends Controller
{

    protected $productCategoryRepository,$productRepository ;
    public function __construct(ProductCategoryInterface $productCategoryRepository,ProductInterface $productRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index(){
        $cat = $this->productCategoryRepository->getList(['active' => 1],['id','title','slug'], 0);
        $products = $this->productRepository->paginate(12,['id','slug','image','title','price'],['active'=>1]);
        return view('web.product.home',compact('cat','products'));
    }

    public function cat($slug){
        $cat = $this->productCategoryRepository->getOneBySlug($slug);
        $cats = $this->productCategoryRepository->getList(['active' => 1],['id','title','slug'], 0);
        $products = $this->productRepository->paginate(12,['id','slug','image','title','price'],['active'=>1,'category_id'=>$cat->id]);
        return view('web.product.cat',compact('cat','cats','products'));
    }

    public function detail ($slugCat,$slug){
        $cat = $this->productCategoryRepository->getOneBySlug($slugCat);
        $products = $this->productRepository->getList(['active' => 1],['id','title','slug','image','price'], 3);
        $product = $this->productRepository->getOneBySlug($slug);
        return view('web.product.detail',compact('cat','product','products'));
    }
}
