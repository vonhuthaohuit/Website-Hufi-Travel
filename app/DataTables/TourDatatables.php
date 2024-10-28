<?php

namespace App\DataTables;

use App\Models\Tour;
use App\Models\TourDatatable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TourDatatables extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('tour.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('tour.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item' data-id='{$query->id}'><i class='far fa-trash-alt'></i></a>";
                $moreBtn = '<div class="dropdown dropleft d-inline">
                <button class="btn btn-primary dropdown-toggle ml-1" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i>
                </button>
                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                   <a class="dropdown-item has-icon" href=""><i class="far fa-heart"></i> Image Gallery</a>
                </div>
              </div>';
                return $editBtn . $deleteBtn;
            })
            ->addColumn('hinhdaidien', function ($query) {
                return "<img width='100px' height='80px' src='" . asset($query->hinhdaidien) . "' >";
            })
            // ->addColumn('tinhtrang', function($query){
            //     if($query->tinhtrang == 1){
            //         $button = '<label class="custom-switch mt-2">
            //             <input type="checkbox" checked name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status" >
            //             <span class="custom-switch-indicator"></span>
            //         </label>';
            //     }else {
            //         $button = '<label class="custom-switch mt-2">
            //             <input type="checkbox" name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
            //             <span class="custom-switch-indicator"></span>
            //         </label>';
            //     }
            //     return $button;
            // })
            ->addColumn('tinhtrang', function ($query) {
                $checked = $query->tinhtrang == 1 ? 'checked' : '';
                return '<label class="custom-switch mt-2">
                <input type="checkbox" ' . $checked . ' name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input change-status">
                <span class="custom-switch-indicator"></span>
            </label>';
            })
            ->rawColumns(['action', "tinhtrang", 'hinhdaidien'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Tour $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('tourdatatables-table')
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
            Column::make('id')->width(50)->title('ID'),
            Column::make('tentour')->width(250)->title('Tên tour'),
            Column::make('motatour')->width(300)->title('Mô tả'),
            Column::make('tinhtrang')->width(100)->title('Tình trạng'),
            Column::make('hinhdaidien')->width(150)->title('Hình ảnh'),
            Column::make('thoigiandi')->width(150)->title('Thời gian đi'),
            Column::make('noikhoihanh')->width(150)->title('Nơi khởi hành'),
            Column::make('loaitour_id')->width(50)->title('ID loại tour'),
            Column::make('khuyenmai_id')->width(50)->title('ID khuyến mãi'),
            Column::make('ngaytao')->width(150)->title('Ngày tạo'),
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
        return 'TourDatatables_' . date('YmdHis');
    }
}
