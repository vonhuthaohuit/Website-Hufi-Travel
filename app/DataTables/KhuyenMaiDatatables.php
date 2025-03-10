<?php

namespace App\DataTables;

use App\Models\KhuyenMai;
use App\Models\KhuyenMaiDatatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KhuyenMaiDatatables extends DataTable
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
                $editBtn = "<a href='" . route('khuyenmai.edit', $query->makhuyenmai) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('khuyenmai.destroy', $query->makhuyenmai) . "' class='btn btn-danger ml-2 delete-item' data-id='{$query->makhuyenmai}'><i class='far fa-trash-alt'></i></a>";
                return $editBtn . $deleteBtn;
            })
            ->editColumn('thoigianbatdau', function ($query) {
                return Carbon::parse($query->thoigianbatdau)->format('d-m-Y'); // Định dạng ngày
            })

            ->editColumn('thoigianketthuc', function ($query) {
                return Carbon::parse($query->thoigianketthuc)->format('d-m-Y'); // Định dạng ngày
            })
            ->editColumn('phantramgiam', function ($query) {
                return $query->phantramgiam . '%';
            })


            ->setRowId('makhuyenmai');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(KhuyenMai $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('makhuyenmai', 'asc');
    }


    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('khuyenmaidatatables-table')
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
            Column::make('thoigianbatdau')->width(250)->title('Thời gian bắt đầu'),
            Column::make('thoigianketthuc')->width(250)->title('Thời gian kết thúc'),
            Column::make('phantramgiam')->width(100)->title('Phần trăm giảm'),
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
        return 'KhuyenMaiDatatables_' . date('YmdHis');
    }
}
