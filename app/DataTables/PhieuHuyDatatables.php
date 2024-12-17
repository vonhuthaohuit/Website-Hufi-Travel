<?php

namespace App\DataTables;

use App\Models\PhieuHuyDatatable;
use App\Models\PhieuHuyTour;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class PhieuHuyDatatables extends DataTable
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
                // $detailsBtn = "<button class='btn btn-info show-details' data-id='{$query->mahoadon}' title='Chi tiết'>
                //                    <i class='far fa-eye'></i>
                //                </button>";
                $detailsBtn = "<a href='" . route('phieuhuytour.edit', $query->maphieuhuytour) . "' class='btn btn-primary'><i class='far fa-eye'></i></a>";
                return $detailsBtn;
            })
            ->editColumn('ngayhuy', function ($query) {
                return date('d-m-Y', strtotime($query->ngayhuy));
            })
            ->editColumn('sotienhoan', function ($query) {
                return number_format($query->sotienhoan, 0, ',', '.') . 'đ';
            })
            ->editColumn('tentour', function ($query) {
                return Str::limit($query->tentour, 80);
            })
            ->editColumn('trangthaidattour', function ($query) {
                if ($query->trangthaidattour === 'Đã hủy') {
                    return '<span class="badge badge-success">' . $query->trangthaidattour . '</span>';
                } elseif($query->trangthaidattour === 'Yêu cầu hủy tour') {
                    return '<span class="badge badge-danger">' . $query->trangthaidattour . '</span>';
                }
            })
            ->rawColumns(['action', 'trangthaidattour'])
            ->setRowId('maphieuhuytour');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PhieuHuyTour $model): QueryBuilder
    {
        return $model->newQuery()
            ->leftJoin('hoadon', 'phieuhuytour.maphieuhuytour', '=', 'hoadon.maphieuhuytour')
            ->leftJoin('phieudattour', 'hoadon.maphieudattour', '=', 'phieudattour.maphieudattour')
            ->leftJoin('tour', 'phieudattour.matour', '=', 'tour.matour')
            ->select('phieuhuytour.*', 'tour.tentour', 'hoadon.nguoidaidien', 'phieudattour.trangthaidattour')
            ->orderBy('maphieuhuytour', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('phieuhuydatatables-table')
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
            Column::make('tentour')->width(300)->title('Tên tour'),
            Column::make('nguoidaidien')->width(150)->title('Người đại diện'),
            Column::make('lydohuy')->width(300)->title('Lý do hủy'),
            Column::make('ngayhuy')->title('Ngày hủy'),
            Column::make('sotienhoan')->title('Số tiền hoàn'),
            Column::make('trangthaidattour')->title('Trạng thái yêu cầu'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->title('Hành động')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PhieuHuyDatatables_' . date('YmdHis');
    }
}
