<?php

namespace App\DataTables;

use App\Models\BlogDatatable;
use App\Models\BlogTour;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogDatatables extends DataTable
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
                $editBtn = "<a href='" . route('blog.edit', $query->mablogtour) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                if (request()->routeIs('nv.blog.index')) {
                    return $editBtn;
                }
                $deleteBtn = "<a href='" . route('blog.destroy', $query->mablogtour) . "' class='btn btn-danger ml-2 delete-item' data-id='{ $query->mablogtour }'><i class='far fa-trash-alt'></i></a>";
                return $editBtn . $deleteBtn;
            })
            ->addColumn('hinhanh', function ($query) {
                return "<img width='100px' height='80px' src='" . asset($query->hinhanh) . "' >";
            })
            ->addColumn('trangthaiblog', function ($query) {
                $checked = $query->trangthaiblog == 1 ? 'checked' : '';
                return '<label class="custom-switch mt-2">
                        <input type="checkbox" ' . $checked . ' name="custom-switch-checkbox" data-id="' . $query->mablogtour . '" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>
                    </label>';
            })
            ->addColumn('loaiblog', function ($query) {
                return $query->loaiblog->tenloaiblog;
            })
            ->addColumn('nhanvien', function ($query) {
                return $query->nhanvien->hoten;
            })
            ->addColumn('ngaytao', function ($query) {
                return date('d-m-Y', strtotime($query->created_at));
            })
            ->addColumn('ngaycapnhat', function ($query) {
                return date('d-m-Y', strtotime($query->updated_at));
            })
            ->rawColumns(['trangthaiblog', 'loaiblog', 'action', 'hinhanh'])
            ->setRowId('mablogtour');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(BlogTour $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('mablogtour', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('blogdatatables-table')
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
            Column::make('hinhanh')->title('Hình ảnh'),
            Column::make('tieude')->title('Tiêu đề'),
            Column::make('trangthaiblog')->title('Trạng thái'),
            Column::make('loaiblog')->title('Loại blog'),
            Column::make('ngaytao')->title('Ngày tạo'),
            Column::make('ngaycapnhat')->title('Ngày cập nhật'),
            Column::make('nhanvien')->title('Nhân viên'),
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
        return 'BlogDatatables_' . date('YmdHis');
    }
}
