<?php

namespace App\DataTables;

use App\Models\PhuongTien_Tour;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class PhuongTien_TourDataTable extends DataTable
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
                // Use `maphuongtien` and `matour` for both edit and delete actions
                $editUrl = route('phuongtien_tour.edit', [$query->matour, $query->maphuongtien]);
                $deleteUrl = route('phuongtien_tour.delete', [$query->matour, $query->maphuongtien]);

                // Define buttons with the correct parameters
                $editBtn = "<a href='{$editUrl}' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='{$deleteUrl}' class='btn btn-danger ml-2 delete-item' data-id='{$query->matour}' data-maphuongtien='{$query->maphuongtien}'><i class='far fa-trash-alt'></i></a>";

                return $editBtn . $deleteBtn;
            })
            ->addColumn('maphuongtien', function ($query) {
                return $query->phuongtien->tenphuongtien;
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(PhuongTien_Tour $model): QueryBuilder
    {
        $tourid = request()->tour_id;
        return $model->newQuery()
            ->where('matour', $tourid)
            ->with('phuongtien')
            ->select('chitietphuongtientour.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('phuongtien_tour-table')
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
            ])
            ->parameters([
                'scrollX' => true, // Bật chế độ cuộn ngang
                'responsive' => true, // Hỗ trợ giao diện responsive
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
            Column::make('maphuongtien')->width(300)->title('Tên phương tiện'),
            Column::make('soluonghanhkhach')->width(300)->title('Só lượng hành khách'),
            Column::make('ghichu')->width(300)->title('Ghi chú'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PhuongTien_Tour_' . date('YmdHis');
    }
}
