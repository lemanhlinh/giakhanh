<?php

namespace App\DataTables;

use App\Models\BookTable;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BooksTableDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('store_id', function ($q) {
                return $q->store->title;
            })
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('H:i:s Y/m/d');
            })
            ->editColumn('updated_at', function ($q) {
                return Carbon::parse($q->updated_at)->format('H:i:s Y/m/d');
            })
            ->addColumn('action', 'bookstabledatatable.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BookTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BookTable $model)
    {
        return $model->newQuery()->with('store');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('books-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('full_name')->title('Họ và tên'),
            Column::make('email')->title('Email'),
            Column::make('phone')->title('Số điện thoại'),
            Column::make('store_id')->searchable(false)->title('Cửa hàng'),
            Column::make('book_time')->title('Ngày đặt'),
            Column::make('book_hour')->title('Giờ đặt'),
            Column::make('number_customers')->title('Số lượng khách'),
            Column::make('note')->title('Ghi chú')->width('300'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'BooksTable_' . date('YmdHis');
    }
}
