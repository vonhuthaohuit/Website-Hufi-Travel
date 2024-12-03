<?php

namespace App\DataTables;

use App\Models\HoaDon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
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
            ->addIndexColumn()
            ->addColumn('action', function ($hoaDon) {
                $detailsBtn = "<button class='btn btn-info show-details' data-id='{$hoaDon->mahoadon}' title='Chi tiết'>
                                   <i class='far fa-eye'></i>
                               </button>";

                $editBtn = "<a href='" . route('hoadon.edit', $hoaDon->mahoadon) . "' class='btn btn-primary ml-2' title='Chỉnh sửa'>
                                <i class='far fa-edit'></i>
                            </a>";

                $deleteBtn = "<a href='" . route('hoadon.destroy', $hoaDon->mahoadon) . "' class='btn btn-danger ml-2 delete-item' data-id='{$hoaDon->mahoadon}'><i class='far fa-trash-alt'></i></a>";


                return $detailsBtn . $editBtn . $deleteBtn;
            })
            ->addColumn('tentour', function ($hoaDon) {
                return $hoaDon->phieudattour && $hoaDon->phieudattour->tour
                    ? $hoaDon->phieudattour->tour->tentour
                    : 'N/A';
            })

            ->setRowId('mahoadon');
    }

    /**
     * Get the query source of dataTable.
     *
     * @param HoaDon $model
     */
    public function query(HoaDon $model): QueryBuilder
    {
        return $model->with(['phieudattour.tour'])
            ->select(
                'hoadon.mahoadon',
                'hoadon.nguoidaidien',
                'hoadon.tongsotien',
                'hoadon.trangthaithanhtoan',
                'hoadon.phuongthucthanhtoan',
                'hoadon.created_at',
                'hoadon.updated_at',
                'hoadon.maphieudattour'
            )
            ->where('hoadon.is_delete', 0);
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
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
                'columnDefs' => [
                    ['targets' => '_all', 'className' => 'text-center'],
                ],
            ])

            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
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
            Column::make('mahoadon')
                ->width(150)
                ->title('Mã hóa đơn'),

            Column::make('tentour')
                ->width(200)
                ->title('Tên tour')
                ->addClass('text-truncate'),

            Column::make('nguoidaidien')
                ->width(200)
                ->title('Người đại diện'),

            Column::make('tongsotien')
                ->width(250)
                ->title('Tổng số tiền'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(250)
                ->addClass('text-center'),
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
