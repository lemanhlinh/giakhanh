<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreUser;
use Illuminate\Http\Request;
use App\DataTables\StoreUserDataTable;

class StoreUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StoreUserDataTable $dataTable)
    {
        return $dataTable->render('admin.store-user.index');
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
     * @param  \App\Models\StoreUser  $storeUser
     * @return \Illuminate\Http\Response
     */
    public function show(StoreUser $storeUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreUser  $storeUser
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreUser $storeUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreUser  $storeUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreUser $storeUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreUser  $storeUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreUser $storeUser)
    {
        //
    }
}
