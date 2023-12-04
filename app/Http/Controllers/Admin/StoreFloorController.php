<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StoreFloorDeskDataTable;
use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\StoreFloor;
use App\Models\StoreFloorDesk;
use Illuminate\Http\Request;
use App\DataTables\StoreFloorDataTable;
use App\Http\Requests\Store\CreateStoreFloor;
use App\Http\Requests\Store\UpdateStoreFloor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StoreFloorController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStoreFloor $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $model = StoreFloor::create($data);
            DB::commit();
            Session::flash('success', trans('message.create_store_floor_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_store_floor_error'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreFloor  $storeFloor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreFloor $req, $id)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $page = StoreFloor::findOrFail($id);
            $page->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_store_floor_success'));
            return redirect()->back();
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_store_floor_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreFloor  $storeFloor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StoreFloor::destroy($id);
        return [
            'status' => true,
            'message' => trans('message.delete_store_floor_success')
        ];
    }

    public function showDesk($storeId, $deskId, StoreFloorDeskDataTable $dataTable){
        $store = Store::findOrFail($storeId);
        $desk = StoreFloor::findOrFail($deskId);
        $types = StoreFloorDesk::TYPE_TYPE;
        return $dataTable->with(['store_id' => $storeId,'desk_id' => $deskId])->render('admin.store-floor-desk.index', compact('store','desk','types'));
    }
}
