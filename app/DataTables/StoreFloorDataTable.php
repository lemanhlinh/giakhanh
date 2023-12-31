<?php

namespace App\DataTables;

use App\Models\StoreFloor;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StoreFloorDataTable extends DataTable
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
            ->editColumn('updated_at', function ($q) {
                return Carbon::parse($q->updated_at)->format('H:i:s Y/m/d');
            })
            ->addColumn('action', function ($q){
                $urlEdit = route('admin.store-floor.edit', $q->id);
                $urlDelete = route('admin.store-floor.destroy', $q->id);
                $urlListDesk = route('admin.store-floor.showDesk', ['storeId'=>$q->store->id,'deskId'=>$q->id]);
                $lowerModelName = strtolower(class_basename(new StoreFloor()));
                return view('admin.components.modals.update-floor-modal', compact('q'))->render() .
                    view('admin.components.buttons.delete', compact('urlDelete', 'lowerModelName'))->render().
                    view('admin.components.buttons.list_desk', compact('urlListDesk'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StoreFloor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StoreFloor $model)
    {
        $storeId = $this->store_id;
        return $model->with([
            'store' => function ($q) use ($storeId) {
                $q->where('id', $storeId);
            }
        ])->whereHas('store', function ($q) use ($storeId) {
            $q->where('store_id', $storeId);
        });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('store-floor-table')
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
            Column::make('name'),
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
        return 'StoreFloor_' . date('YmdHis');
    }
}
