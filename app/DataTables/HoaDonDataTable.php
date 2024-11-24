<?php

namespace App\DataTables;

use App\Models\HoaDon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HoaDonDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($hoaDon) {
                $detailsBtn = "<button class='btn btn-info show-details' data-id='{$hoaDon->mahoadon}' title='Chi tiết'>
                               <i class='far fa-eye'></i>
                           </button>";

                $editBtn = "<a href='" . route('hoadon.edit', $hoaDon->mahoadon) . "' class='btn btn-primary ml-2' title='Chỉnh sửa'>
                            <i class='far fa-edit'></i>
                        </a>";

                $deleteBtn = "<button class='btn btn-danger ml-2 delete-item' data-id='{$hoaDon->mahoadon}' title='Xóa'>
                              <i class='far fa-trash-alt'></i>
                          </button>";

                return $detailsBtn . $editBtn . $deleteBtn;
            })
            ->addColumn('tentour', function ($hoaDon) {
                return $hoaDon->phieudattour && $hoaDon->phieudattour->tour
                    ? $hoaDon->phieudattour->tour->tentour
                    : 'N/A';
            })
            ->setRowId('mahoadon');
    }


    public function query(HoaDon $model): QueryBuilder
    {
        return $model->with(['phieudattour.tour'])
            ->select('hoadon.mahoadon', 'hoadon.nguoidaidien', 'hoadon.tongsotien',
             'hoadon.trangthaithanhtoan', 'hoadon.phuongthucthanhtoan',
              'hoadon.created_at', 'hoadon.maphieudattour');
    }





    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('hoadon-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('mahoadon'),
            Column::make('tentour'),
            Column::make('nguoidaidien'),
            Column::make('tongsotien'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
        ];
    }



    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'HoaDon_' . date('YmdHis');
    }
}
