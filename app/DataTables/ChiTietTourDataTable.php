<?php

namespace App\DataTables;

use App\Models\ChiTietTour;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
class ChiTietTourDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        //, $query->madiemdulich
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($query) {
            $editBtn = "<a href='" . route('chitiettour.edit',[$query->matour,$query->madiemdulich]) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href='" . route('chitiettour.delete',[$query->matour,$query->madiemdulich]) . "' class='btn btn-danger ml-2 delete-item' data-id='{$query->matour}'><i class='far fa-trash-alt'></i></a>";
             return $editBtn . $deleteBtn;
        })
        ->addColumn('matour',function($query)
        {
            return $query->tour->tentour ;
        })
        ->addColumn('madiemdulich',function($query)
        {
            return $query->diemdulich->tendiemdulich ;
        })

        ->rawColumns(['action','matour','madiemdulich'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ChiTietTour $model): QueryBuilder
    {
        $tourid = request()->tour_id;
        return $model->newQuery()
        ->where('matour', $tourid)
        ->with('diemdulich')
        ->select('chitiettour.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('chitiettour-table')
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
           // Column::make('id'),
            Column::make('ngaybatdau')->width(200)->title('Ngày bắt đầu'),
            Column::make('ngayketthuc')->width(200)->title('Ngày kết thúc'),
            Column::make('giachitiettour')->width(200)->title('Giá vé'),
            column::make('matour')->width(400)->title('Tên tour'),
            Column::make('madiemdulich')->width(200)->title('Tên điểm'),
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
        return 'ChiTietTour_' . date('YmdHis');
    }
}
