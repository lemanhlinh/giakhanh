<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\ProductsTranslation;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
                $url = route('admin.product.changeActive', $q->id);
                $status = $q->active == ProductsTranslation::STATUS_ACTIVE ? 'checked' : null;
                return view('admin.components.buttons.change_status', [
                    'url' => $url,
                    'lowerModelName' => 'product',
                    'status' => $status,
                ])->render();
            })
            ->editColumn('is_home', function ($q) {
                $url = route('admin.product.changeHome', $q->id);
                $status = $q->is_home == ProductsTranslation::IS_HOME ? 'checked' : null;
                return view('admin.components.buttons.change_status', [
                    'url' => $url,
                    'lowerModelName' => 'product',
                    'status' => $status,
                ])->render();
            })
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('H:i:s Y/m/d');
            })
            ->editColumn('updated_at', function ($q) {
                return Carbon::parse($q->updated_at)->format('H:i:s Y/m/d');
            })
            ->addColumn('action', function ($q) use ($lang){
                $urlEdit = route('admin.product.edit', $q->product_id).'?local='.$lang;
                $urlDelete = route('admin.product.destroy', $q->product_id).'?local='.$lang;
                $lowerModelName = strtolower(class_basename(new ProductsTranslation()));
                return view('admin.components.buttons.edit', compact('urlEdit'))->render() . view('admin.components.buttons.delete', compact('urlDelete', 'lowerModelName'))->render();
            })->rawColumns(['active','action','is_home']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProductsTranslation $model)
    {
        $lang = request()->input('local','vi');
        return $model->newQuery()->with('category')->where(['lang'=>$lang]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('product-table')
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
            Column::make('image')->title(trans('form.product.image'))->render([
                'renderImage(data)'
            ]),
            Column::make('active')->title('Kích hoạt'),
            Column::make('is_home')->title('Hiển thị trang chủ'),
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
        return 'Product_' . date('YmdHis');
    }
}
