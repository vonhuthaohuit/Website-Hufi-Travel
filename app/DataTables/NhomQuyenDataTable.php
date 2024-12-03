<?php

namespace App\DataTables;

use App\Models\NhomQuyen;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class NhomQuyenDataTable extends DataTable
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
            $editBtn = "<a href='" . route('nhomquyen.edit', $query->manhomquyen) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href='" . route('nhomquyen.destroy', $query->manhomquyen) . "' class='btn btn-danger ml-2 delete-item' data-id='{$query->maquyen}'><i class='far fa-trash-alt'></i></a>";
            $moreBtn = '<div class="dropdown dropleft d-inline">
                <button class="btn btn-primary dropdown-toggle ml-1" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i>
                </button>
                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                   <a class="dropdown-item has-icon" href="' . route('quyen_nhomquyen.index', ['manhomquyen' => $query->manhomquyen]) . '" ><i class="far fa-heart"></i>Phần quyền</a>
                   </div>
              </div>';
            return $editBtn . $deleteBtn . $moreBtn;
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
    public function query(NhomQuyen $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('nhomquyen-table')
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
            Column::make('tennhomquyen')->width(200)->title('Tên quyền'),
            Column::make('created_at')->width(150)->title('Ngày tạo') ->addClass('text-center'),
            Column::make('updated_at')->width(150)->title('Cập nhật lần cuối') ->addClass('text-center'),
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
        return 'NhomQuyen_' . date('YmdHis');
    }
}
