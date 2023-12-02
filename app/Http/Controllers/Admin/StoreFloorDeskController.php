<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreFloor;
use App\Models\StoreFloorDesk;
use Illuminate\Http\Request;
use App\DataTables\StoreFloorDeskDataTable;
use App\Http\Requests\Store\CreateStoreFloorDesk;
use App\Http\Requests\Store\UpdateStoreFloorDesk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        $store_floors = StoreFloor::all();
        $types = StoreFloorDesk::TYPE_TYPE;
        return view('admin.store-floor-desk.create',compact('types','store_floors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStoreFloorDesk $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $model = StoreFloorDesk::create($data);
            DB::commit();
            Session::flash('success', trans('message.create_store_floor_desk_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_store_floor_desk_error'));
            return redirect()->back();
        }
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
    public function edit($id)
    {
        $store_floor_desk = StoreFloorDesk::findOrFail($id);
        $store_floors = StoreFloor::all();
        $types = StoreFloorDesk::TYPE_TYPE;
        return view('admin.store-floor-desk.update', compact('store_floor_desk','store_floors','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreFloorDesk  $storeFloorDesk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreFloorDesk $req, $id)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $page = StoreFloorDesk::findOrFail($id);
            $page->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_store_floor_desk_success'));
            return redirect()->route('admin.store-floor-desk.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_store_floor_desk_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreFloorDesk  $storeFloorDesk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StoreFloorDesk::destroy($id);
        return [
            'status' => true,
            'message' => trans('message.delete_store_floor_desk_success')
        ];
    }
}
