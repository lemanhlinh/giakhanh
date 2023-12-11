<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookTable\UpdateBookTable;
use App\Models\BookTable;
use App\Models\Store;
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
        return view('admin.book-table.update', compact('bookTable','stores'));
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
            $order->update($data);
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
}
