<?php

namespace App\DataTables;

use App\Models\LoaiBlog;
use App\Models\LoaiBlogDatatable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LoaiBlogDatatables extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('checkbox', function ($query) {
                return "<input type='checkbox' class='delete-checkbox' data-id='{$query->maloaiblog}' />";
            })
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('loaiblog.edit', $query->maloaiblog) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('loaiblog.destroy', $query->maloaiblog) . "' class='btn btn-danger ml-2 delete-item' data-id='{$query->maloaiblog}'><i class='far fa-trash-alt'></i></a>";
                return $editBtn . $deleteBtn;
            })
            ->rawColumns(['checkbox', 'action'])
            ->setRowId('maloaiblog');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LoaiBlog $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('maloaiblog', 'asc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('loaiblogdatatables-table')
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
                Button::make('reload'),
                Button::make('selectedDelete')->text('Xóa đã chọn')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('STT')
                ->exportable(false)
                ->printable(false)
                ->width(30)
                ->addClass('text-center'),
            Column::make('tenloaiblog')->title('Tên loại blog'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'LoaiBlogDatatables_' . date('YmdHis');
    }
}
