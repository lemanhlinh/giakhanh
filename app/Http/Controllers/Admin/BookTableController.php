<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookTable\UpdateBookTable;
use App\Models\BookTable;
use App\Models\StoreCustomer;
use App\Models\Store;
use App\Models\StoreFloor;
use App\Models\StoreFloorDesk;
use Illuminate\Http\Request;
use App\DataTables\BooksTableDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BooksTableDataTable $dataTable)
    {
        return $dataTable->render('admin.book-table.index');
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
     * @param  \App\Models\BookTable  $bookTable
     * @return \Illuminate\Http\Response
     */
    public function show(BookTable $bookTable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookTable  $bookTable
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stores = Store::all();
        $bookTable = BookTable::findOrFail($id);
        $floors = StoreFloor::where('store_id', $bookTable->store_id)->get();
        $floor_id = $bookTable->floor_id;
        $desks = StoreFloorDesk::where('store_id', $bookTable->store_id)->when($floor_id, function ($query, $floor_id) {
            return $query->where('store_floor_id', $floor_id);
        })->get();
        return view('admin.book-table.update', compact('bookTable','stores','desks','floors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookTable  $bookTable
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookTable $request, $id)
    {
        DB::beginTransaction();
        try {
            $order = BookTable::findOrFail($id);
            $data = $request->validated();
            $status = $data['status'];
            $order->update($data);
            if ($status == 2){
                $customer = StoreCustomer::where('book_table_id', $id)->first();
                if (!$customer){
                    $data['type'] = 1;
                    $data['book_table_id'] = $id;
                    StoreCustomer::create($data);
                }else{
                    $customer->update($data);
                }
            }else{
                StoreCustomer::where('book_table_id', $id)->delete();
            }
            DB::commit();
            Session::flash('success', trans('message.update_order_success'));
            return redirect()->route('admin.book-table.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_order_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookTable  $bookTable
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BookTable::destroy($id);
        return [
            'status' => true,
            'message' => trans('message.delete_book_table_success')
        ];
    }


    public function loadFloor(Request $request)
    {
        $store_id = $request->input('store_id');
        $floors = StoreFloor::where('store_id', $store_id)->get();
        $result = array();
        $result['error'] = false;
        $result['floors'] = $floors;
        return json_encode($result);
    }

    public function loadDesk(Request $request)
    {
        $store_id = $request->input('store_id');
        $floor_id = $request->input('floor_id');
        $desks = StoreFloorDesk::where(['store_id'=>$store_id,'store_floor_id'=>$floor_id])->get();
        $result = array();
        $result['error'] = false;
        $result['desks'] = $desks;
        return json_encode($result);
    }

}
