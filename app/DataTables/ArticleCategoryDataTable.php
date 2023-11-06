<?php

namespace App\DataTables;

use App\Models\ArticlesCategories;
use App\Models\ArticlesCategoriesTranslation;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ArticleCategoryDataTable extends DataTable
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
                $url = route('admin.article-category.changeActive', $q->id);
                $status = $q->active == ArticlesCategoriesTranslation::STATUS_ACTIVE ? 'checked' : null;
                return view('admin.components.buttons.change_status', [
                    'url' => $url,
                    'lowerModelName' => 'articles-categories',
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
                $urlEdit = route('admin.article-category.edit', $q->article_category_id).'?local='.$lang;
                $urlDelete = route('admin.article-category.destroy', $q->article_category_id).'?local='.$lang;
                $lowerModelName = strtolower(class_basename(new ArticlesCategoriesTranslation()));
                return view('admin.components.buttons.edit', compact('urlEdit'))->render() . view('admin.components.buttons.delete', compact('urlDelete', 'lowerModelName'))->render();
            })->rawColumns(['active','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ArticlesCategoriesTranslation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ArticlesCategoriesTranslation $model)
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
                    ->setTableId('articlecategory-table')
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
            Column::make('title')->title(trans('form.article_category.title')),
            Column::make('image')->title(trans('form.article_category.image'))->render([
                'renderImage(data)'
            ]),
            Column::make('active')->title(trans('form.article.active')),
            Column::make('created_at')->title(trans('form.created_at')),
            Column::make('updated_at')->title(trans('form.updated_at')),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center')
                ->title(trans('form.action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ArticleCategory_' . date('YmdHis');
    }
}
