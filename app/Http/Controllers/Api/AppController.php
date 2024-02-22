<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductsCategories;
use App\Models\StoreCustomer;
use App\Models\StoreDeskOrder;
use App\Models\StoreDeskOrderCustomer;
use Illuminate\Http\Request;
use App\Events\MessagePosted;
use App\Events\OrderFood;

class AppController extends Controller
{
    public function listCatProduct($storeId){
        $cats = ProductsCategories::where(['active'=>1])->with(['products'=>function($query) use ($storeId){
            $query->where('price','!=', null)->where('active',1)->where(function ($query) use ($storeId) {
                $query->whereNull('store_id')
                    ->orWhere('store_id', $storeId);
            });
        }])->get();
        return $cats;
    }

    public function customerAddFoodUse(Request $request)
    {
        $customer_name = $request->input('customer_name');
        $customer_phone = $request->input('customer_phone');
        $storeId = $request->input('store_id');
        $floorId = $request->input('floor_id');
        $tableId = $request->input('table_id');
        $order_list = $request->input('order_list');
        $customer = StoreCustomer::where(['store_id'=>$storeId,'table_id'=>$tableId,'use_table'=>1])->first();
        if ($order_list && $customer){
            foreach ($order_list as $item){
                $product = Product::findOrFail($item['id']);
                $data = [
                    'customer_name'=> $customer_name,
                    'customer_phone'=> $customer_phone,
                    'store_id' => $storeId,
                    'table_id' => $tableId,
                    'product_id' => $item['id'],
                    'product_name' => $product->title,
                    'price' => $item['price'],
                    'quantity' => $item['quantity']
                ];
                StoreDeskOrderCustomer::create($data);

                $order = StoreDeskOrder::where([
                    'customer_id'=> $customer->id,
                    'store_id' => $storeId,
                    'table_id' => $tableId,
                    'product_id' => $item['id']
                ])->first();
                if ($order){
                    $data = [
                        'quantity' => ($order->quantity + $item['quantity'])
                    ];
                    $order->update($data);
                }else{
                    if ($item){
                        $data = [
                            'customer_id'=> $customer->id,
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
//            $products = StoreDeskOrder::where([
//                'customer_id'=> $customer->id,
//                'store_id' => $storeId,
//                'table_id' => $tableId
//            ])->get();
//            $total_price = 0;
//            foreach ($products as $item){
//                $total_price = $total_price + ($item->price * $item->quantity);
//            }
            $order_list = [
                'order_list'=> $order_list,
                'store_id' => $storeId,
                'floor_id' => $floorId,
                'table_id' => $tableId
            ];
            broadcast(new OrderFood($order_list))->toOthers();
            return response()->json(array(
                'error' => false,
//                'total_price' => $total_price,
                'message' => 'Đã order món thành công'
            ));
        }else{
            return response()->json(array(
                'error' => true,
                'message' => 'Chưa order được món'
            ));
        }
    }
}
