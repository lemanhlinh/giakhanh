<?php

namespace App\DataTables;

use App\Models\StoreFloor;
use App\Models\StoreFloorDesk;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StoreFloorDeskDataTable extends DataTable
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
                $urlDelete = route('admin.store-floor.destroy', $q->id);
                $lowerModelName = strtolower(class_basename(new StoreFloor()));
                $types = StoreFloorDesk::TYPE_TYPE;
                return view('admin.components.modals.update-floor-desk-modal', compact('q','types'))->render() .
                    view('admin.components.buttons.delete', compact('urlDelete', 'lowerModelName'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StoreFloorDesk $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StoreFloorDesk $model)
    {
        $storeId = $this->store_id;
        $deskId = $this->desk_id;
        return $model->with([
            'store' => function ($q) use ($storeId) {
                $q->where('id', $storeId);
            }, 'storeFloor' => function ($q) use ($deskId) {
                $q->where('id', $deskId);
            }
        ])->whereHas('store', function ($q) use ($storeId) {
            $q->where('store_id', $storeId);
        })->whereHas('storeFloor', function ($q) use ($deskId) {
            $q->where('store_floor_id', $deskId);
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
                    ->setTableId('store-floor-desk-table')
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
            Column::make('number_desk'),
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
        return 'StoreFloorDesk_' . date('YmdHis');
    }
}
