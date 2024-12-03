<?php

namespace App\DataTables;

use App\Models\KhachSan;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class KhachSanDataTable extends DataTable
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
            $editBtn = "<a href='" . route('khachsan.edit', $query->makhachsan) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href='" . route('khachsan.destroy', $query->makhachsan) . "' class='btn btn-danger ml-2 delete-item' data-id='{$query->makhachsan}'><i class='far fa-trash-alt'></i></a>";
            return $editBtn . $deleteBtn;
        })
        ->editColumn('created_at', function ($query) {
            return Carbon::parse($query->created_at)->format('d-m-Y'); // Định dạng ngày
        })

        ->editColumn('updated_at', function ($query) {
            return Carbon::parse($query->updated_at)->format('d-m-Y'); // Định dạng ngày
        })
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(KhachSan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('khachsan-table')
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
          //  Column::make('id'),
           // Column::make('makhachsan'),
           Column::computed('DT_RowIndex')
           ->title('STT')
           ->exportable(false)
           ->printable(false)
           ->width(30)
           ->addClass('text-center'),
            Column::make('tenkhachsan')->width(150)->title('Tên khách sạn'),
            Column::make('diachi')->width(150)->title('Địa chỉ'),
            Column::make('sodienthoai')->width(150)->title('Số điện thoại'),
            Column::make('chatluong')->width(100)->title('Chất lượng')
            ->addClass('text-center'),
            Column::make('giakhachsan')->width(100)->title('Giá')
            ->addClass('text-center'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
                  ->addClass('text-center')

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'KhachSan_' . date('YmdHis');
    }
}
