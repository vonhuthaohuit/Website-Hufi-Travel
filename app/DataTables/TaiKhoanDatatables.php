<?php

namespace App\DataTables;

use App\Models\TaiKhoanDatatable;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TaiKhoanDatatables extends DataTable
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
            ->addColumn('trangthai', function ($query) {
                $checked = $query->trangthai == 'Hoạt động' ? 'checked' : '';
                return '<label class="custom-switch mt-2">
                        <input type="checkbox" ' . $checked . ' name="custom-switch-checkbox" data-id="' . $query->mataikhoan . '" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>
                    </label>';
            })
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('taikhoan.edit', $query->mataikhoan) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                // $deleteBtn = "<a href='" . route('taikhoan.destroy', $query->mataikhoan) . "' class='btn btn-danger ml-2 delete-item' data-id='{ $query->mataikhoan }'><i class='far fa-trash-alt'></i></a>";
                return $editBtn;
            })
            ->editColumn('created_at', function ($query) {
                return date('d-m-Y', strtotime($query->created_at));
            })
            ->rawColumns(['trangthai', 'action'])
            ->setRowId('mataikhoan');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->with('nhomquyen')->where('manhomquyen', '=', 2)->orderBy('mataikhoan', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('taikhoandatatables-table')
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
            Column::make('tentaikhoan')->width(150)->title('Tên tài khoản'),
            Column::make('email')->width(150)->title('Email'),
            Column::make('trangthai')->width(100)->title('Trạng thái'),
            // Column::make('nhomquyen.tennhomquyen')->title('Nhóm quyền'),
            Column::make('created_at')->width(150)->title('Ngày tạo'),
            // Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(160)
                ->title('Chức năng')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'TaiKhoanDatatables_' . date('YmdHis');
    }
}
