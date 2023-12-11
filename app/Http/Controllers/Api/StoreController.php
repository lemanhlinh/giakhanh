<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookTable\CreateBookTable;
use App\Models\BookTable;
use App\Models\Product;
use App\Models\Store;
use App\Models\StoreFloor;
use App\Models\StoreFloorDesk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller
{
    public function listStore()
    {
        $list = Store::where('active',1)->orderBy('id','DESC')->get();
        return $list;
    }
    public function listTable($storeId)
    {
        $list = StoreFloor::where('active',1)->with(['FloorDesk','Store'])
            ->whereHas('FloorDesk', function($q) use ($storeId){
                $q->where('store_id', $storeId)->where('active',1);
            })->where('store_id', $storeId)->where('active',1)->get();
        return $list;
    }

    public function listFood()
    {
        $list = Product::where('active',1)->get();
        return $list;
    }

    public function bookTable($storeId, $tableId)
    {
        $list = Product::where('active',1)->get();
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
            BookTable::create($data);
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
