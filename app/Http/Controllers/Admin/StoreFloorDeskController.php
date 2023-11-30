<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreFloorDesk;
use Illuminate\Http\Request;
use App\DataTables\StoreFloorDeskDataTable;

class StoreFloorDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StoreFloorDeskDataTable $dataTable)
    {
        return $dataTable->render('admin.store-floor-desk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\StoreFloorDesk  $storeFloorDesk
     * @return \Illuminate\Http\Response
     */
    public function show(StoreFloorDesk $storeFloorDesk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreFloorDesk  $storeFloorDesk
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreFloorDesk $storeFloorDesk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreFloorDesk  $storeFloorDesk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreFloorDesk $storeFloorDesk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreFloorDesk  $storeFloorDesk
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreFloorDesk $storeFloorDesk)
    {
        //
    }
}
