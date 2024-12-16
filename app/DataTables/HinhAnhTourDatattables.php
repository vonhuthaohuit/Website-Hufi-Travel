<?php

namespace App\DataTables;

use App\Models\HinhAnhTour;
use App\Models\HinhAnhTourDatattable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HinhAnhTourDatattables extends DataTable
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
            ->addColumn('duongdan', function ($query) {
                return "<img width='100px' height='80px' src='" . asset($query->duongdan) . "' >";
            })
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('hinhanhtour.edit', [$query->mahinhanh, $query->matour]) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('hinhanhtour.destroy', $query->mahinhanh) . "' class='btn btn-danger ml-2 delete-item' data-id='{ $query->mahinhanh }'><i class='far fa-trash-alt'></i></a>";
                return $editBtn . $deleteBtn;
            })
            ->rawColumns(['action', 'duongdan'])
            ->setRowId('mahinhanh');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(HinhAnhTour $model): QueryBuilder
    {
        $tourid = request()->tour_id;
        return $model->newQuery()
            ->with('tour')
            ->where('matour', $tourid)
            ->orderBy('mahinhanh', 'asc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('hinhanhtourdatattables-table')
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
            Column::computed('DT_RowIndex')
                ->title('STT')
                ->exportable(false)
                ->printable(false)
                ->width(30)
                ->addClass('text-center'),
            Column::make('duongdan')->title('Hình ảnh'),
            Column::make('tour.tentour')->title('Tour'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->title('Hành động')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'HinhAnhTourDatattables_' . date('YmdHis');
    }
}
