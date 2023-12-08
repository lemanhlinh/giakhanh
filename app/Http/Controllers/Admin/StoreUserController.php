<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\StoreUser;
use Illuminate\Http\Request;
use App\DataTables\StoreUserDataTable;
use App\Http\Requests\Store\CreateStoreUser;
use App\Http\Requests\Store\UpdateStoreUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        $stores = Store::all();
        return view('admin.store-user.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStoreUser $req)
    {
        DB::beginTransaction();
        try {
            $stores_id = $req->input('stores');
            $stores_id = implode(',',$stores_id);
            $user = StoreUser::create([
                'name' => $req->input('name'),
                'email' => $req->input('email'),
                'phone' => $req->input('phone'),
                'password' => Hash::make($req->input('password')),
                'active' => $req->input('active'),
                'type' => $req->input('type'),
                'stores' => $stores_id,
                'gender' => $req->input('gender'),
                'birthday' => $req->input('birthday'),
                'address' => $req->input('address'),
            ]);

            DB::commit();
            Session::flash('success', trans('message.create_user_success'));

            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollback();
        }
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
        $stores = Store::all();
        $user = StoreUser::findOrFail($id);
        $storeIdsOfUser = explode(',',$user->stores);
        return view('admin.store-user.update',compact('stores','user','storeIdsOfUser'));
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
        DB::beginTransaction();
        try {
            $user = StoreUser::findOrFail($id);
            $stores_id = $req->input('stores');
            $stores_id = implode(',',$stores_id);
            $user->update([
                'name' => $req->input('name'),
                'email' => $req->input('email'),
                'phone' => $req->input('phone'),
                'active' => $req->input('active'),
                'type' => $req->input('type'),
                'stores' => $stores_id,
                'gender' => $req->input('gender'),
                'birthday' => $req->input('birthday'),
                'address' => $req->input('address'),
            ]);

            DB::commit();
            Session::flash('success', trans('message.update_user_success'));
            return redirect()->route('admin.store-user.edit', $id);
        } catch (\Exception $exception) {
            DB::rollback();

            Session::flash('danger', trans('message.update_user_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreUser  $storeUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StoreUser::destroy($id);

        return [
            'status' => true,
            'message' => trans('message.delete_user_success')
        ];
    }
}
