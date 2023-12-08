<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use App\Models\StoreFloor;
use App\Models\StoreFloorDesk;
use Illuminate\Http\Request;

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

    public function listFood($storeId, $tableId)
    {
        $list = StoreFloorDesk::where('active',1)->get();
        return $list;
    }
}
