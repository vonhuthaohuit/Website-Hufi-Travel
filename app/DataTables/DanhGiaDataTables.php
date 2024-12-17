<?php

namespace App\DataTables;

use App\Models\DanhGia;
use App\Models\DanhGiaDataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class DanhGiaDataTables extends DataTable
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
                $deleteBtn = "<a href='" . route('danhgia.destroy', $query->madanhgia) . "' class='btn btn-danger ml-2 delete-item' data-id='{ $query->madanhgia }'><i class='far fa-trash-alt'></i></a>";
                return $deleteBtn;
            })
            ->addColumn('tinhtrang', function ($query) {
                $checked = $query->tinhtrang == 1 ? 'checked' : '';
                return '<label class="custom-switch mt-2">
                        <input type="checkbox" ' . $checked . ' name="custom-switch-checkbox" data-id="' . $query->madanhgia . '" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>
                    </label>';
            })
            ->addColumn('nguoidanhgia', function ($query) {
                return $query->khachhang->hoten;
            })
            ->addColumn('ngaytao', function ($query) {
                return date('d-m-Y', strtotime($query->created_at));
            })
            ->editColumn('tentour', function ($query) {
                return Str::limit($query->tentour, 80);
            })
            ->editColumn('noidung', function ($query) {
                return Str::limit($query->noidung, 80);
            })
            ->editColumn('diemdanhgia', function ($query) {
                return '<span class="d-flex align-items-center">' . $query->diemdanhgia . ' <i class="fas fa-star ms-2 mb-1" style="color: #ffa801;"></i></span>';
            })
            ->rawColumns(['tinhtrang', 'ngaytao', 'action', 'diemdanhgia' ])
            ->setRowId('madanhgia');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(DanhGia $model): QueryBuilder
    {
        return $model->newQuery()
        // ->with('khachhang')
        ->join('tour', 'danhgia.matour', '=', 'tour.matour')
        ->join('khachhang', 'danhgia.makhachhang', '=', 'khachhang.makhachhang')
        ->select('danhgia.*', 'tour.tentour', 'khachhang.hoten')
        ->orderBy('madanhgia', 'asc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('danhgiadatatables-table')
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
            Column::make('tentour')->title('Tên tour')->width(300),
            Column::make('noidung')->title('Nội Dung')->width(300),
            Column::make('diemdanhgia')->title('Điểm đánh giá')->width(100),
            Column::make('tinhtrang')->title('Tình trạng')->width(150),
            Column::make('nguoidanhgia')->title('Người đánh giá')->width(150),
            Column::make('ngaytao')->title('Ngày đánh giá')->width(150),
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
        return 'DanhGiaDataTables_' . date('YmdHis');
    }
}
