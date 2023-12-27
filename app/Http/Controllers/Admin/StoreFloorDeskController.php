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
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StoreFloorDeskController extends Controller
{

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
            $store_id = $data['store_id'];
            $store_floor_id = $data['store_floor_id'];
            $model = StoreFloorDesk::create($data);
            $url = env('URL_TABLE_APP').'/goi-mon/'.$store_id.'/'.$store_floor_id.'/'.$model->id;
            $imageQr = QrCode::size(300)->generate($url);
            $model->update(['image_qr' => $imageQr]);
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

            $store_id = $data['store_id'];
            $store_floor_id = $data['store_floor_id'];
            $url = env('URL_TABLE_APP').'/goi-mon/'.$store_id.'/'.$store_floor_id.'/'.$id;
            $data['image_qr'] = QrCode::format('png')->size(300)->generate($url);
            $page->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_store_floor_desk_success'));
            return redirect()->back();
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
