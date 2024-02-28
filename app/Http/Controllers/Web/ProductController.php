<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailBookTable;
use App\Jobs\SendEmailOrder;
use App\Models\BookTable;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductsCategoriesTranslation;
use App\Models\ProductsTranslation;
use App\Models\Setting;
use App\Models\Store;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductCategoryInterface;
use App\Repositories\Contracts\ProductInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Order\CreateOrder;
use App\Http\Requests\BookTable\CreateBookTable;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProductController extends Controller
{

    protected $productCategoryRepository,$productRepository ;
    public function __construct(ProductCategoryInterface $productCategoryRepository,ProductInterface $productRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index(){
        $logo = Setting::where('key', 'logo')->first();

        SEOTools::setTitle('Sản phẩm - Lẩu nấm gia khánh');
        SEOTools::setDescription('Mỗi sản phẩm của Lẩu Nấm Gia Khánh đều được qua sàng lọc , chắt chiu, tinh khiết và quý báu nhất từ thiên nhiên. Nhằm mang đến cho thực khách những món ăn có giá trị về chất lượng và luôn lấy tiêu chí “Sức khỏe con người làm trung tâm”');
        SEOMeta::setKeywords('Lẩu nấm gia khánh, lẩu nấm');
        SEOTools::addImages(asset($logo->value));
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('launamgiakhanh.vn');

        $lang = LaravelLocalization::getCurrentLocale()?LaravelLocalization::getCurrentLocale():'vi';
        $cat = ProductsCategoriesTranslation::select('id','title','slug','product_category_id')->where(['active' => 1,'lang'=>$lang])->get();
        $products = ProductsTranslation::select('id','slug','image','title','price','category_id','product_id')
            ->where(['active' => 1,'lang'=>$lang])->with(['categoryTranslation' => function($query) use ($lang){
                $query->where(['active' => 1,'lang'=>$lang]);
            }])->whereNull('store_id')->paginate(12);
        return view('web.product.home',compact('cat','products'));
    }

    public function cat($slug){
        $lang = LaravelLocalization::getCurrentLocale()?LaravelLocalization::getCurrentLocale():'vi';
        $cat = ProductsCategoriesTranslation::select('id','title','slug','product_category_id')->where(['active' => 1,'lang'=>$lang,'slug'=>$slug])->first();
        $cats = ProductsCategoriesTranslation::select('id','title','slug','product_category_id')->where(['active' => 1,'lang'=>$lang])->get();
        $products = ProductsTranslation::select('id','slug','image','title','price','category_id','product_id')
            ->where(['active'=>1,'category_id'=>$cat->id,'lang'=>$lang])->whereNull('store_id')->with(['category'])->orderBy('id','DESC')->paginate(12);

        SEOTools::setTitle($cat->seo_title?$cat->seo_title:$cat->title);
        SEOTools::setDescription($cat->seo_description?$cat->seo_description:$cat->description);
        SEOTools::addImages($cat->image?asset($cat->image):null);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('launamgiakhanh.vn');
        SEOMeta::setKeywords($cat->seo_keyword?$cat->seo_keyword:$cat->title);

        return view('web.product.cat',compact('cat','cats','products'));
    }

    public function detail ($slug){
        $lang = LaravelLocalization::getCurrentLocale()?LaravelLocalization::getCurrentLocale():'vi';
        $product = ProductsTranslation::where(['active' => 1,'lang'=>$lang,'slug'=>$slug])->first();
        $cat = ProductsCategoriesTranslation::select('id','title','slug','product_category_id')->where(['active' => 1,'lang'=>$lang,'id'=>$product->category_id])->first();
        $products = ProductsTranslation::select('id','slug','image','title','price','category_id','product_id')
            ->where(['active'=>1,'category_id'=>$cat->id,'lang'=>$lang])->whereNull('store_id')->with(['category'])->orderBy('id','DESC')->limit(3)->get();

        SEOTools::setTitle($product->seo_title?$product->seo_title:$product->title);
        SEOTools::setDescription($product->seo_description?$product->seo_description:$product->description);
        SEOTools::addImages($product->image?asset($product->image):null);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('launamgiakhanh.vn');
        SEOMeta::setKeywords($product->seo_keyword?$product->seo_keyword:$product->title);

        return view('web.product.detail',compact('cat','product','products'));
    }

    public function bookTable (CreateBookTable $req){
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $store_id = $data['store_id'];
            $store = Store::findOrFail($store_id);
            BookTable::create($data);
            SendEmailBookTable::dispatch($data, $store)->delay(now()->addMinute(1));
            DB::commit();
            Session::flash('success', trans('message.create_book_table_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_book_table_error'));
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function addToCart (Request $req){
        $productId = $req['id'];
        $quantity = $req['quantity'];
        $product = $this->productRepository->getOneById($productId);


        $cart = Session::get('cart', []);

        if (array_key_exists($product->id, $cart)) {
            // Sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng
            $cart[$product->id]['quantity'] = $cart[$product->id]['quantity']+$quantity;
        } else {
            // Sản phẩm chưa tồn tại trong giỏ hàng, thêm mới
            $cart[$product->id] = [
                'name' => $product->title,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        Session::put('cart', $cart);

        $totalQuantity = 0;
        foreach ($cart as $item) {
            $totalQuantity += $item['quantity'];
        }

        return response()->json(array(
            'success' => true,
            'total'   => $totalQuantity
        ));
    }

    public function showCart()
    {
        $cart = Session::get('cart', []);
        // Duyệt qua các sản phẩm trong giỏ hàng để lấy thông tin sản phẩm
        $cartItems = [];
        $total_price = 0;
        if (!$cart){
            Session::flash('danger', 'Chưa có sản phẩm nào trong giỏ hàng');
            return redirect()->route('home');
        }
        foreach ($cart as $productId => $item) {
            $product = $this->productRepository->getOneById($productId);
            $quantity = $item['quantity']; // Số lượng

            // Thêm thông tin sản phẩm vào danh sách
            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $product->price * $quantity, // Tính tổng tiền cho mỗi sản phẩm
            ];
            $total_price = $total_price + $product->price * $quantity;
        }

        return view('web.cart.cart', compact('cart','cartItems','total_price'));
    }

    public function updateCart(Request $request)
    {
        $productId = $request->input('id');
        $quantity = $request->input('quantity');

        // Lấy giỏ hàng hiện tại từ Session
        $cart = Session::get('cart', []);

        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (array_key_exists($productId, $cart)) {
            // Cập nhật số lượng sản phẩm
            $cart[$productId]['quantity'] = $quantity;

            // Lưu giỏ hàng vào Session
            Session::put('cart', $cart);

            // Trả về thông báo cập nhật thành công hoặc redirect đến trang giỏ hàng
            $totalQuantity = 0;

            $total_price = 0;
            foreach ($cart as $id => $item) {
                $totalQuantity += $item['quantity'];

                $product = $this->productRepository->getOneById($id);
                $quantity = $item['quantity']; // Số lượng

                // Thêm thông tin sản phẩm vào danh sách
//                $cartItems[] = [
//                    'product' => $product,
//                    'quantity' => $quantity,
//                    'subtotal' => $product->price * $quantity, // Tính tổng tiền cho mỗi sản phẩm
//                ];
                $total_price = $total_price + $product->price * $quantity;
            }

            return response()->json(array(
                'success' => true,
                'total'   => $totalQuantity
            ));
        } else {
            // Sản phẩm không tồn tại trong giỏ hàng, xử lý lỗi
        }
    }

    public function removeItem(Request $request, $productId)
    {
        // Lấy giỏ hàng hiện tại từ Session
        $cart = Session::get('cart', []);

        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (array_key_exists($productId, $cart)) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($cart[$productId]);

            // Lưu giỏ hàng vào Session
            Session::put('cart', $cart);

            // Trả về thông báo xóa thành công hoặc redirect đến trang giỏ hàng
            Session::flash('success', 'Xóa sản phẩm trong giỏ hàng thành công');
            return redirect()->back();
        } else {
            // Sản phẩm không tồn tại trong giỏ hàng, xử lý lỗi
            Session::flash('danger', 'Chưa xóa được sản phẩm trong giỏ hàng');
            return redirect()->back();
        }
    }

    public function order (CreateOrder $req){
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $order = Order::create($data);

            SendEmailOrder::dispatch($data)->delay(now()->addMinute(1));

            $cart = Session::get('cart', []);
            foreach ($cart as $productId => $item) {
                $product = $this->productRepository->getOneById($productId);
                if (empty($product)){
                    unset($cart[$productId]);
                    Session::flash('danger', 'Có sản phẩm không còn tồn tại');
                    return redirect()->back();
                }
                $quantity = $item['quantity']; // Số lượng
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_title' => $product->title,
                    'product_number' => $quantity,
                    'product_price' => $product->price,
                ]);
            }
            DB::commit();
            Session::flash('success', trans('message.create_order_success'));
            return redirect()->route('orderProductSuccess',['id'=>$order->id]);
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_order_error'));
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function success ($id){
        Session::forget('cart');
        $order = Order::findOrFail($id);
        return view('web.cart.register_success',compact('order'));
    }

    public function sendMessZalo (){
        $client = new Client();
        $headers = [
            'access_token' => '',
            'Content-Type' => 'application/json'
        ];
        $body = '{
            "phone": "84987654321",
            "template_id": "7895417a7d3f9461cd2e",
            "template_data": {
                "ky": "1",
                "thang": "4/2020",
                "start_date": "20/03/2020",
                "end_date": "20/04/2020",
                "customer": "Nguyễn Thị Hoàng Anh",
                "cid": "PE010299485",
                "address": "VNG Campus, TP.HCM",
                "amount": "100",
                "total": "100000",
             },
            "tracking_id":"tracking_id"
        }';
        $request = new Request('POST', 'https://openapi.zalo.me/v3.0/oa/message/transaction', $headers, $body);
        $res = $client->sendAsync($request)->wait();

        $data = json_decode($res->getBody(), true);
        if ($data['error'] == 0){
            return response()->json(array(
                'error' => true,
                'message'   => 'Đã gửi thành công',
            ));
        }
    }
}
