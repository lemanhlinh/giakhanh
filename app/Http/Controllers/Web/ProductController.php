<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductCategoryInterface;
use App\Repositories\Contracts\ProductInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        $products = $this->productRepository->paginate(12,['id','slug','image','title','price','category_id'],['active'=>1],['category']);
        return view('web.product.home',compact('cat','products'));
    }

    public function cat($slug){
        $cat = $this->productCategoryRepository->getOneBySlug($slug);
        $cats = $this->productCategoryRepository->getList(['active' => 1],['id','title','slug'], 0);
        $products = $this->productRepository->paginate(12,['id','slug','image','title','price','category_id'],['active'=>1,'category_id'=>$cat->id],['category']);
        return view('web.product.cat',compact('cat','cats','products'));
    }

    public function detail ($slugCat,$slug){
        $cat = $this->productCategoryRepository->getOneBySlug($slugCat);
        $products = $this->productRepository->getList(['active' => 1],['id','title','slug','image','price','category_id'], 3,['category']);
        $product = $this->productRepository->getOneBySlug($slug);
        return view('web.product.detail',compact('cat','product','products'));
    }

    public function order (CreateContact $req){
        DB::beginTransaction();
        try {
            $data = $req->validated();
            Order::create(
                [
                    'name' => $data['name'],
                    'content' => $data['content'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'address' =>  $data['address'],
                ]
            );
            DB::commit();
            Session::flash('success', trans('message.create_contact_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_contact_error'));
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function success ($id){
        $cat = $this->productCategoryRepository->getOneById($id);
        return view('web.cart.register_success');
    }
}
