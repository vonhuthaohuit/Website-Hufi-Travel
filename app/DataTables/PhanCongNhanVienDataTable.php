<?php

namespace App\DataTables;

use App\Models\PhanCongNhanVien;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class PhanCongNhanVienDataTable extends DataTable
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
                $tourId = request()->tour_id; // Lấy tour_id từ request
                $deleteBtn = "<a href='" . route('phancongnhanvien.delete', [$tourId,$query->manhanvien]) . "' class='btn btn-danger ml-2 delete-item' data-id='{$query->manhanvien}'><i class='far fa-trash-alt'></i></a>";
                return $deleteBtn;
            })
            ->editColumn('created_at', function ($query) {
                return Carbon::parse($query->created_at)->format('d-m-Y'); // Định dạng ngày
            })

            ->editColumn('updated_at', function ($query) {
                return Carbon::parse($query->updated_at)->format('d-m-Y'); // Định dạng ngày
            })
            ->addColumn('manhanvien', function ($query) {
                return $query->nhanvien->hoten;
            })

            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(PhanCongNhanVien $model): QueryBuilder
    {
        $tourid = request()->tour_id;
        return $model->newQuery()
            ->where('matour', $tourid)
            ->with('nhanvien')
            ->select('phancongnhanvien.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('phancongnhanvien-table')
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
            Column::make('manhanvien')->width(150)->title('Họ và tên'),
            Column::make('nhiemvu')->width(150)->title('Nhiệm vụ'),
            Column::make('created_at')->width(150)->title('Ngày tạo'),
            Column::make('updated_at')->width(150)->title('Ngày cập nhật'),
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
        return 'PhanCongNhanVien_' . date('YmdHis');
    }
}
