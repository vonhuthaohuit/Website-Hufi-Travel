<?php

namespace App\DataTables;

use App\Models\KhachSan_Tour;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class KhachSan_TourDataTable extends DataTable
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

            ->addColumn('action', function ($query) {

                $editBtn = "<a href='" . route('khachsan_tour.edit', [$query->matour, $query->makhachsan]) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('khachsan_tour.delete', [$query->matour, $query->makhachsan]) . "' class='btn btn-danger ml-2 delete-item' data-id='{$query->matour}'><i class='far fa-trash-alt'></i></a>";
                return $editBtn . $deleteBtn;
            })
            ->addColumn('makhachsan', function ($query) {
                return $query->khachsan->tenkhachsan;
            })
            ->setRowId(['action', 'makhachsan'])

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(KhachSan_Tour $model): QueryBuilder
    {
        $tourid = request()->tour_id;
        return $model->newQuery()
            ->where('matour', $tourid)
            ->with('khachsan')
            ->select('chitietkhachsantour.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('chitietkhachsantour-table')
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

            Column::make('makhachsan')->width(300)->title('Tên khách sạn'),
            Column::make('vitriphong')->width(250)->title('Vị trí phòng'),
            Column::make('succhua')->width(250)->title('Sức chứa khu vực'),
            Column::computed('DT_RowIndex')
                ->title('STT')
                ->exportable(false)
                ->printable(false)
                ->width(30)
                ->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),


        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'KhachSan_Tour_' . date('YmdHis');
    }
}
