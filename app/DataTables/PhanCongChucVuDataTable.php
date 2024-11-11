<?php

namespace App\DataTables;

use App\Models\PhanCongChucVu;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class PhanCongChucVuDataTable extends DataTable
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
            $deleteBtn = "<a href='" . route('phancongchucvu.delete',[$query->manhanvien,$query->machucvu]) . "' class='btn btn-danger ml-2 delete-item' data-id='{$query->manhomquyen}'><i class='far fa-trash-alt'></i></a>";
             return $deleteBtn;
        })
        ->editColumn('created_at', function ($query) {
            return Carbon::parse($query->created_at)->format('d-m-Y'); // Định dạng ngày
        })

        ->editColumn('updated_at', function ($query) {
            return Carbon::parse($query->updated_at)->format('d-m-Y'); // Định dạng ngày
        })
        ->addColumn('manhanvien',function($query)
        {
            return $query->nhanvien->hoten ;
        })
        ->addColumn('machucvu',function($query)
        {
            return $query->chucvu->tenchucvu ;
        })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PhanCongChucVu $model): QueryBuilder
    {
        $manhanvien = request()->manhanvien;
        return $model->newQuery()
        ->where('manhanvien', $manhanvien)
        ->with('chucvu')
        ->select('phancongchucvu.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('phancongchucvu-table')
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
            Column::make('manhanvien')->width(150)->title('Nhân viên'),
            Column::make('machucvu')->width(150)->title('Chức vụ'),
            Column::make('created_at')->width(150)->title('Ngày tạo'),
            Column::make('updated_at')->width(150)->title('Cập nhật lần cuối'),
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
        return 'PhanCongChucVu_' . date('YmdHis');
    }
}
