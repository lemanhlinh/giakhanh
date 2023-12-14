<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookTable\CreateBookTable;
use App\Models\BookTable;
use App\Models\Product;
use App\Models\Store;
use App\Models\StoreFloor;
use App\Models\StoreFloorDesk;
use App\Models\StoreDeskOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class StoreController extends Controller
{
    public function listStore()
    {
        $list = Store::where('active',1)->orderBy('id','DESC')
            ->with(['storeFloorDesk' => function($q){

            }])->get();
        return $list;
    }
    public function listTable($storeId)
    {
        $list = StoreFloor::where('active',1)->with(['FloorDesk' => function ($query) use ($storeId) {
            $query->where('store_id', $storeId)->where('active', 1)
                ->with(['BookTable']);
        }])->where('store_id', $storeId)->get();
        return $list;
    }

    public function detailTable($storeId,$tableId)
    {
        $data = StoreFloorDesk::where(['active' => 1, 'store_id' => $storeId, 'id' => $tableId])->with(['BookTable' => function($query){
            $query->where('is_come', 1)->with(['StoreDeskOrder']);
        }])->first();
        return $data;
    }

    public function listFood()
    {
        $list = Product::where('active',1)->get();
        return $list;
    }

    public function listFoodUse(Request $request)
    {
        $book_table_id = $request->input('book_table_id');
        if ($book_table_id){
            $storeId = $request->input('store_id');
            $tableId = $request->input('table_id');
            $order = StoreDeskOrder::where([
                'book_table_id'=> $book_table_id,
                'store_id' => $storeId,
                'table_id' => $tableId
            ])->with('products')->get();
            return $order;
        }else{
            return null;
        }

    }

    public function addFoodUse(Request $request)
    {
        $book_table_id = $request->input('book_table_id');
        $storeId = $request->input('store_id');
        $tableId = $request->input('table_id');
        $order_list = $request->input('order_list');
        foreach ($order_list as $item){
            $order = StoreDeskOrder::where([
                'book_table_id'=> $book_table_id,
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
                $data = [
                    'book_table_id'=> $book_table_id,
                    'store_id' => $storeId,
                    'table_id' => $tableId,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity']
                ];
                StoreDeskOrder::create($data);
            }
        }
    }

    public function bookTable(Request $request)
    {
        $storeId = $request->input('store_id');
        $tableId = $request->input('table_id');
        $status = $request->input('status');
        $list = BookTable::where(['status' => $status, 'store_id' => $storeId, 'table_id' => $tableId])->orderBy('id','DESC')->get();
        return $list;
    }

    public function historyTable($storeId, $tableId)
    {
        $list = Product::where('active',1)->get();
        return $list;
    }

    public function createBookTable (CreateBookTable $req){
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $storeId = $data['store_id'];
            $tableId = $data['table_id'];
            BookTable::create($data);
//            $bookTables = BookTable::where(['store_id'=>$storeId,'table_id'=>$tableId])->get();
//            if ($bookTables){
//
//            }
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            return false;
        }
        return false;
    }

    public function usingTable (Request $request){
        {
            $storeId = $request->input('store_id');
            $tableId = $request->input('table_id');
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
                $data2['is_come'] = 1;
                $data2['status'] = 2;
                BookTable::create($data2);
                DB::commit();
                return true;
            } catch (\Exception $ex) {
                DB::rollBack();
                \Log::info([
                    'message' => $ex->getMessage(),
                    'line' => __LINE__,
                    'method' => __METHOD__
                ]);

                return false;
            }
            return false;
        }
    }

    public function updateIsCome (Request $request){
        {
            $storeId = $request->input('store_id');
            $tableId = $request->input('table_id');
            $bookId = $request->input('book_id');
            $status = $request->input('status');
            DB::beginTransaction();
            try {
                $data['is_come'] = 1;
                $book_table = BookTable::findOrFail($bookId);
                $book_table->update($data);

                $data2['status'] = $status;
                $desk = StoreFloorDesk::findOrFail($tableId);
                $desk->update($data2);
                DB::commit();
                return true;
            } catch (\Exception $ex) {
                DB::rollBack();
                \Log::info([
                    'message' => $ex->getMessage(),
                    'line' => __LINE__,
                    'method' => __METHOD__
                ]);

                return false;
            }
            return false;
        }
    }
}
