<?php

namespace App\DataTables;

use App\Models\Quyen;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class QuyenDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($query) {
            $editBtn = "<a href='" . route('quyen.edit', $query->maquyen) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href='" . route('quyen.destroy', $query->maquyen) . "' class='btn btn-danger ml-2 delete-item' data-id='{$query->maquyen}'><i class='far fa-trash-alt'></i></a>";
            return $editBtn . $deleteBtn;
        })
        ->editColumn('created_at', function ($query) {
            return Carbon::parse($query->created_at)->format('d-m-Y'); // Định dạng ngày
        })

        ->editColumn('updated_at', function ($query) {
            return Carbon::parse($query->updated_at)->format('d-m-Y'); // Định dạng ngày
        })
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Quyen $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('quyen-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('maquyen'),
            Column::make('tenquyen')->width(200)->title('Tên quyền'),
            Column::make('mota')->width(200)->title('Mô tả'),
            Column::make('created_at')->width(150)->title('Ngày tạo'),
            Column::make('updated_at')->width(150)->title('Cập nhật lần cuối'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150
                  )
                  ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Quyen_' . date('YmdHis');
    }
}
