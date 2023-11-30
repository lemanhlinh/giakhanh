<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\StoreFloor;
use Illuminate\Http\Request;
use App\DataTables\StoreFloorDataTable;

class StoreFloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StoreFloorDataTable $dataTable)
    {
        return $dataTable->render('admin.store-floor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::all();
        return view('admin.store-floor.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreFloor  $storeFloor
     * @return \Illuminate\Http\Response
     */
    public function show(StoreFloor $storeFloor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreFloor  $storeFloor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stores = Store::all();
        $store_floor = StoreFloor::findOrFail($id);
        return view('admin.store-floor.update', compact('stores','store_floor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreFloor  $storeFloor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreFloor $storeFloor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreFloor  $storeFloor
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreFloor $storeFloor, $id)
    {
        $storeFloor->destroy($id);
        return [
            'status' => true,
            'message' => trans('message.delete_store_floor_success')
        ];
    }
}
