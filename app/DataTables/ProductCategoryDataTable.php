<?php

namespace App\DataTables;

use App\Models\ProductsCategories;
use App\Models\ProductsCategoriesTranslation;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductCategoryDataTable extends DataTable
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
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('H:i:s Y/m/d');
            })
            ->editColumn('updated_at', function ($q) {
                return Carbon::parse($q->updated_at)->format('H:i:s Y/m/d');
            })
            ->addColumn('action', function ($q) use ($lang){
                $urlEdit = route('admin.product-category.edit', $q->product_category_id).'?local='.$lang;
                $urlDelete = route('admin.product-category.destroy', $q->product_category_id).'?local='.$lang;
                $lowerModelName = strtolower(class_basename(new ProductsCategoriesTranslation()));
                return view('admin.components.buttons.edit', compact('urlEdit'))->render() . view('admin.components.buttons.delete', compact('urlDelete', 'lowerModelName'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProductsCategories $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProductsCategoriesTranslation $model)
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
                    ->setTableId('product-category-table')
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
            Column::make('title')->title(trans('form.product_category.title')),
            Column::make('active')->title(trans('form.product_category.active')),
            Column::make('created_at')->title(trans('form.created_at')),
            Column::make('updated_at')->title(trans('form.updated_at')),
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
        return 'ProductCategory_' . date('YmdHis');
    }
}
