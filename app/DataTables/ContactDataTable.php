<?php

namespace App\DataTables;

use App\Models\Contact;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ContactDataTable extends DataTable
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
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('H:i:s Y/m/d');
            })
            ->addColumn('action', 'contact-table.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Contact $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contact $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('contact-table')
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
            Column::make('full_name')->title("Họ và Tên"),
            Column::make('phone')->title(trans('form.contact.phone')),
            Column::make('email')->title(trans('form.contact.email')),
            Column::make('title')->title("Vấn đề cần trao đổi"),
            Column::make('content')->title(trans('form.contact.content')),
            Column::make('created_at')
//            Column::computed('action')
//                ->exportable(false)
//                ->printable(false)
//                ->width(60)
//                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Contact_' . date('YmdHis');
    }
}
