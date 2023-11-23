<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function listStore()
    {
        $list = Store::where('active',1)->get();
        return $list;
    }
    public function listTable()
    {
        $list = Store::where('active',1)->get();
        return $list;
    }

    public function listFood()
    {
        $list = Product::where('active',1)->get();
        return $list;
    }
}
