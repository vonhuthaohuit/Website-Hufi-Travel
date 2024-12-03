<?php

namespace App\DataTables;

use App\Models\Quyen_NhomQuyen;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class Quyen_NhomQuyenDataTable extends DataTable
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
            $deleteBtn = "<a href='" . route('quyen_nhomquyen.delete',[$query->manhomquyen,$query->maquyen]) . "' class='btn btn-danger ml-2 delete-item' data-id='{$query->manhomquyen}'><i class='far fa-trash-alt'></i></a>";
             return $deleteBtn;
        })
        ->editColumn('created_at', function ($query) {
            return Carbon::parse($query->created_at)->format('d-m-Y'); // Định dạng ngày
        })

        ->editColumn('updated_at', function ($query) {
            return Carbon::parse($query->updated_at)->format('d-m-Y'); // Định dạng ngày
        })
        ->addColumn('manhomquyen',function($query)
        {
            return $query->nhomquyen->tennhomquyen ;
        })
        ->addColumn('maquyen',function($query)
        {
            return $query->quyen->tenquyen ;
        })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Quyen_NhomQuyen $model): QueryBuilder
    {
        $manhomquyen = request()->manhomquyen;
        return $model->newQuery()
        ->where('manhomquyen', $manhomquyen)
        ->with('quyen')
        ->select('quyen_nhomquyen.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('quyen_nhomquyen-table')
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
            Column::computed('DT_RowIndex')
            ->title('STT')
            ->exportable(false)
            ->printable(false)
            ->width(30)
            ->addClass('text-center'),
            Column::make('manhomquyen')->width(150)->title('Nhóm quyền'),
            Column::make('maquyen')->width(150)->title('Tên quyền'),
            Column::make('created_at')->width(150)->title('Ngày tạo'),
            Column::make('updated_at')->width(150)->title('Cập nhật lần cuối'),
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
        return 'Quyen_NhomQuyen_' . date('YmdHis');
    }
}
