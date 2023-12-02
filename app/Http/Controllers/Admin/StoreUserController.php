<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreUser;
use Illuminate\Http\Request;
use App\DataTables\StoreUserDataTable;
use App\Http\Requests\Store\CreateStoreUser;
use App\Http\Requests\Store\UpdateStoreUser;

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
        return view('admin.store-user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStoreUser $req)
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
    public function edit($id)
    {
        return view('admin.store-user.update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreUser  $storeUser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreUser $req, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreUser  $storeUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
