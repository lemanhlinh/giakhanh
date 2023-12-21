<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use App\Models\StoreCustomer;
use App\Models\StoreFloor;
use App\Models\StoreFloorDesk;
use App\Models\StoreDeskOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StoreController extends Controller
{
    public function listStore(Request $request)
    {
        $stores_id = $request->input('stores_id');
        $stores_id = explode(',',$stores_id);
        $list = Store::where('active',1)->whereIn('id', $stores_id)->orderBy('id','DESC')
            ->with(['storeFloorDesk' => function($query){
                $query->where('active', 1)
                    ->with(['StoreCustomer']);
            }])->get();
        return $list;
    }
    public function listTable($storeId)
    {
        $list = StoreFloor::where(['active' => 1, 'store_id' =>$storeId])
            ->with(['FloorDesk' => function ($query) use ($storeId) {
            $query->where('store_id', $storeId)->where('active', 1)
                ->with(['StoreCustomer'  => function ($query){
                    $query->orderBy('use_table','ASC');
                }]);
        }])->get();
        return $list;
    }

    public function detailTable($storeId,$floorId,$tableId)
    {
        $data = StoreFloorDesk::where(['active' => 1, 'store_id' => $storeId, 'id' => $tableId])->with(['StoreCustomerUse' => function($query){
            $query->with(['StoreDeskOrder']);
        }])->first();

        $total_price = 0;
        if ($data->StoreCustomerUse && $data->StoreCustomerUse->StoreDeskOrder){
            $products = $data->StoreCustomerUse->StoreDeskOrder;
            if ($products){
                foreach ($products as $item){
                    $total_price = $total_price + ($item->price * $item->quantity);
                }
            }
        }
        return response()->json(array(
            'error' => false,
            'result' => $data,
            'total_price' => $total_price
        ));
    }

    public function listFood()
    {
        $list = Product::where('active',1)->get();
        return $list;
    }

    public function listFoodUse(Request $request)
    {
        $customer_id = $request->input('customer_id');
        if ($customer_id){
            $storeId = $request->input('store_id');
            $tableId = $request->input('table_id');
            $products = Product::join('store_desk_order', 'products.id', '=', 'store_desk_order.product_id')
                ->whereIn('store_desk_order.id', function ($query) use ($customer_id, $storeId, $tableId) {
                    $query->select('id')
                        ->from('store_desk_order')
                        ->where([
                            'customer_id' => $customer_id,
                            'store_id' => $storeId,
                            'table_id' => $tableId
                        ]);
                })
                ->where('products.active', 1)
                ->select('products.*', 'store_desk_order.quantity as quantity')
                ->get();
            $total_price = 0;
            foreach ($products as $item){
                $total_price = $total_price + ($item->price * $item->quantity);
            }
            return response()->json(array(
                'error' => false,
                'products' => $products,
                'total_price' => $total_price
            ));
        }else{
            return response()->json(array(
                'error' => true,
                'products' => [],
                'total_price' => 0,
                'message' => 'Lỗi không có bàn đặt trước'
            ));
        }
    }

    public function addFoodUse(Request $request)
    {
        $customer_id = $request->input('customer_id');
        $storeId = $request->input('store_id');
        $tableId = $request->input('table_id');
        $order_list = $request->input('order_list');
        if ($order_list){
            foreach ($order_list as $item){
                $order = StoreDeskOrder::where([
                    'customer_id'=> $customer_id,
                    'store_id' => $storeId,
                    'table_id' => $tableId,
                    'product_id' => $item['id']
                ])->first();
                if ($order){
                    $data = [
                        'quantity' => $item['quantity']
                    ];
                    $order->update($data);
                }else{
                    if ($item){
                        $data = [
                            'customer_id'=> $customer_id,
                            'store_id' => $storeId,
                            'table_id' => $tableId,
                            'product_id' => $item['id'],
                            'price' => $item['price'],
                            'quantity' => $item['quantity']
                        ];
                        StoreDeskOrder::create($data);
                    }
                }
            }
            $products = StoreDeskOrder::where([
                'customer_id'=> $customer_id,
                'store_id' => $storeId,
                'table_id' => $tableId
            ])->get();
            $total_price = 0;
            foreach ($products as $item){
                $total_price = $total_price + ($item->price * $item->quantity);
            }
            return response()->json(array(
                'error' => false,
                'total_price' => $total_price
            ));
        }else{
            return response()->json(array(
                'error' => true,
                'message' => 'Chưa thêm được món'
            ));
        }

    }

    public function updateFoodUse(Request $request)
    {
        $customer_id = $request->input('customer_id');
        $storeId = $request->input('store_id');
        $tableId = $request->input('table_id');
        $product = $request->input('product');
        if ($product){
            $order = StoreDeskOrder::where([
                'customer_id'=> $customer_id,
                'store_id' => $storeId,
                'table_id' => $tableId,
                'product_id' => $product['id']
            ])->first();
            if ($order){
                $data = [
                    'quantity' => $product['quantity']
                ];
                $order->update($data);
            }else{
                return response()->json(array(
                    'error' => true,
                    'message' => 'Chưa update được món'
                ));
            }
            $products = StoreDeskOrder::where([
                'customer_id'=> $customer_id,
                'store_id' => $storeId,
                'table_id' => $tableId
            ])->get();
            $total_price = 0;
            foreach ($products as $item){
                $total_price = $total_price + ($item->price * $item->quantity);
            }
            return response()->json(array(
                'error' => false,
                'total_price' => $total_price
            ));
        }else{
            return response()->json(array(
                'error' => true,
                'message' => 'Chưa update được món'
            ));
        }

    }

    public function removeFoodUse(Request $request)
    {
        $customer_id = $request->input('customer_id');
        $storeId = $request->input('store_id');
        $tableId = $request->input('table_id');
        $product_id = $request->input('product_id');
        $order = StoreDeskOrder::where([
            'customer_id'=> $customer_id,
            'store_id' => $storeId,
            'table_id' => $tableId,
            'product_id' => $product_id
        ])->first();
        if ($order){
            $order->delete();
            $products = StoreDeskOrder::where([
                'customer_id'=> $customer_id,
                'store_id' => $storeId,
                'table_id' => $tableId
            ])->get();
            $total_price = 0;
            foreach ($products as $item){
                $total_price = $total_price + ($item->price * $item->quantity);
            }
            return response()->json(array(
                'error' => false,
                'total_price' => $total_price,
                'message' => 'Đã xóa món thành công'
            ));
        }else{
            return response()->json(array(
                'error' => true,
                'message' => 'Lỗi không có sản phẩm này'
            ));
        }

    }

    public function bookTable(Request $request)
    {
        $storeId = $request->input('store_id');
        $tableId = $request->input('table_id');
        $status = $request->input('status');
        $list = StoreCustomer::where(['status' => $status, 'store_id' => $storeId, 'table_id' => $tableId,'use_table' => 2])->orderBy('id','DESC')->get();
        return $list;
    }

    public function historyTable($storeId, $floorId ,$tableId)
    {
        $data = StoreFloorDesk::where(['active' => 1, 'store_id' => $storeId, 'id' => $tableId])->with(['StoreCustomerHistory' => function($query){
            $query->with(['StoreDeskOrder']);
        }])->first();
        if ($data){
            return response()->json(array(
                'error' => false,
                'result' => $data,
                'message' => 'Lịch sử đặt bàn'
            ));
        }else{
            return response()->json(array(
                'error' => true,
                'message' => 'Lấy lịch sử đặt bàn không thành công'
            ));
        }

    }

    public function createBookTable (Request $request){
        DB::beginTransaction();
        try {
            $data['full_name'] = $request->input('full_name');
            $data['book_time'] = $request->input('book_time');
            $data['phone'] = $request->input('phone');
            $data['book_hour'] = $request->input('book_hour');
            $data['store_id'] = $request->input('store_id');
            $data['table_id'] = $request->input('table_id');
            $data['floor_id'] = $request->input('floor_id');
            $data['status'] = $request->input('status');
            $data['type'] = 2;
            $data['use_table'] = 2;
            $data['type_payment'] = 2;
            StoreCustomer::create($data);
            DB::commit();
            return response()->json(array(
                'error' => false,
                'message' => 'Đặt bàn thành công'
            ));
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            return response()->json(array(
                'error' => true,
                'message' => 'Đặt bàn không thành công'
            ));
        }
        return response()->json(array(
            'error' => true,
            'message' => 'Đặt bàn không thành công'
        ));
    }

    public function usingTable (Request $request){
        {
            $storeId = $request->input('store_id');
            $tableId = $request->input('table_id');
            $floorId = $request->input('floor_id');
            $status = $request->input('status');
            $currentTime = Carbon::now();
            $date = $currentTime->format('Y-m-d');
            $time = $currentTime->format('H:i:s');

            DB::beginTransaction();
            try {
                $data['status'] = $status;
                $desk = StoreFloorDesk::findOrFail($tableId);
                $desk->update($data);

                $data2['full_name'] = 'Chưa có tên';
                $data2['phone'] = 0;
                $data2['book_time'] = $date;
                $data2['book_hour'] = $time;
                $data2['table_id'] = $tableId;
                $data2['store_id'] = $storeId;
                $data2['floor_id'] = $floorId;
                $data2['time_come'] = $currentTime;
                $data2['status'] = 2;
                $data2['type'] = 2;
                $data2['use_table'] = 1;
                StoreCustomer::create($data2);
                DB::commit();
                return response()->json(array(
                    'error' => true,
                    'message' => 'Sử dụng bàn thành công'
                ));
            } catch (\Exception $ex) {
                DB::rollBack();
                \Log::info([
                    'message' => $ex->getMessage(),
                    'line' => __LINE__,
                    'method' => __METHOD__
                ]);

                return response()->json(array(
                    'error' => true,
                    'message' => 'Chưa sử dùng bàn'
                ));
            }
            return false;
        }
    }

    public function updateIsCome (Request $request){
        {
            $storeId = $request->input('store_id');
            $tableId = $request->input('table_id');
            $floorId = $request->input('floor_id');
            $customerId = $request->input('customer_id');
            $status = $request->input('status');
            DB::beginTransaction();
            try {
                $check = StoreCustomer::where(['store_id'=>$storeId,'table_id'=>$tableId,'floor_id'=>$floorId,'use_table'=>1])->get();
                if ($check){
                    return response()->json(array(
                        'error' => true,
                        'message' => 'Bàn này đang có người sử dụng'
                    ));
                }else{
                    $data['use_table'] = 1;
                    $book_table = StoreCustomer::findOrFail($customerId);
                    $book_table->update($data);
                    DB::commit();
                    return response()->json(array(
                        'error' => true,
                        'message' => 'Sử dụng bàn thành công'
                    ));
                }

            } catch (\Exception $ex) {
                DB::rollBack();
                \Log::info([
                    'message' => $ex->getMessage(),
                    'line' => __LINE__,
                    'method' => __METHOD__
                ]);

                return response()->json(array(
                    'error' => true,
                    'message' => 'Chưa sử dùng bàn'
                ));
            }
            return response()->json(array(
                'error' => true,
                'message' => 'Chưa sử dùng bàn'
            ));
        }
    }

    public function paymentTable(Request $request)
    {
        $customer_id = $request->input('customer_id');
        $full_name = $request->input('full_name');
        $voucher = $request->input('voucher');
        $phone = $request->input('phone');
        $table_id = $request->input('table_id');
        $store_id = $request->input('store_id');
        $total_price = $request->input('total_price');

        $order = StoreCustomer::where([
            'id'=> $customer_id,
            'store_id' => $store_id,
            'table_id' => $table_id,
        ])->first();
        if ($order){
            $data = [
                'voucher' => $voucher,
                'full_name' => $full_name,
                'phone' => $phone,
                'type_payment' => 1,
                'use_table' => 3,
                'total_price' => $total_price,
            ];
            $order->update($data);
            return response()->json(array(
                'error' => false,
                'message' => 'Thanh toán thành công'
            ));
        }else{
            return response()->json(array(
                'error' => true,
                'message' => 'Thanh toán chưa thành công'
            ));
        }
    }
}
