<?php

namespace App\DataTables;

use App\Models\Page;
use App\Models\PagesTranslation;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PageDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $lang = request()->input('local','vi');
        return datatables()
            ->eloquent($query)
            ->editColumn('active', function ($q) {
                $url = route('admin.page.changeActive', $q->id);
                $status = $q->active == PagesTranslation::STATUS_ACTIVE ? 'checked' : null;
                return view('admin.components.buttons.change_status', [
                    'url' => $url,
                    'lowerModelName' => 'page',
                    'status' => $status,
                ])->render();
            })
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('H:i:s Y/m/d');
            })
            ->editColumn('updated_at', function ($q) {
                return Carbon::parse($q->updated_at)->format('H:i:s Y/m/d');
            })
            ->addColumn('action', function ($q) use ($lang) {
                $urlEdit = route('admin.page.edit', $q->page_id).'?local='.$lang;
                $urlDelete = route('admin.page.destroy', $q->page_id).'?local='.$lang;
                $lowerModelName = strtolower(class_basename(new PagesTranslation()));
                return view('admin.components.buttons.edit', compact('urlEdit'))->render() . view('admin.components.buttons.delete', compact('urlDelete', 'lowerModelName'))->render();
            })->rawColumns(['active','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Page $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PagesTranslation $model)
    {
        $lang = request()->input('local','vi');
        return $model->newQuery()->where(['lang'=>$lang]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('page-table')
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
            Column::make('title'),
            Column::make('active'),
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
        return 'Page_' . date('YmdHis');
    }
}
