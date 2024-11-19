<?php

namespace App\DataTables;

use App\Models\Tour;
use App\Models\TourDatatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Str;
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
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('tour.edit', $query->matour) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('tour.destroy', $query->matour) . "' class='btn btn-danger ml-2 delete-item' data-id='{$query->matour}'><i class='far fa-trash-alt'></i></a>";
                $moreBtn = '<div class="dropdown dropleft d-inline">
                <button class="btn btn-primary dropdown-toggle ml-1" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i>
                </button>
                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                   <a class="dropdown-item has-icon" href="' . route('chuongtrinhtour.index', ['tour_id' => $query->matour]) . '" ><i class="far fa-heart"></i>Chương Trình Tour</a>
                   <a class="dropdown-item has-icon" href="' . route('chitiettour.index', ['tour_id' => $query->matour]) . '" ><i class="far fa-heart"></i>Chi tiết tour</a>
                   <a class="dropdown-item has-icon" href="' . route('phuongtien_tour.index', ['tour_id' => $query->matour]) . '" ><i class="far fa-heart"></i>Phương Tiện Tour</a>
                   <a class="dropdown-item has-icon" href="' . route('khachsan_tour.index', ['tour_id' => $query->matour]) . '" ><i class="far fa-heart"></i>Khách Sạn Tour</a>
                   </div>
              </div>';
                return $editBtn . $deleteBtn .  $moreBtn;
            })
            ->addColumn('hinhdaidien', function ($query) {
                return "<img width='100px' height='80px' src='" . asset($query->hinhdaidien) . "' >";
            })



            ->addColumn('maloaitour',function($query)
            {
                return $query->loaitour->tenloai ;
            })

            ->addColumn('makhuyenmai', function($query) {
                return $query->khuyenmai ? $query->khuyenmai->phantramgiam . '%' : 'Không có khuyến mãi';
            })

            ->editColumn('motatour', function ($query) {
                return Str::limit($query->motatour, 70); // Giới hạn 100 ký tự
            })
            ->addColumn('tinhtrang', function ($query) {
                // Kiểm tra giá trị của tinhtrang
                if ($query->tinhtrang == 2) {
                    return '<span class="text-muted">Không thể thay đổi</span>'; // Hoặc bạn có thể sử dụng một cách hiển thị khác
                } else {
                    // Nếu tinhtrang khác 2, cho phép thay đổi
                    $checked = $query->tinhtrang == 1 ? 'checked' : '';
                    return '<label class="custom-switch mt-2">
                        <input type="checkbox" ' . $checked . ' name="custom-switch-checkbox" data-id="' . $query->matour . '" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>
                    </label>';
                }
            })
            ->rawColumns(['action', "tinhtrang", 'hinhdaidien','maloaitour','makhuyenmai'])
            ->setRowId('matour');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Tour $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('matour', 'asc');
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
            Column::computed('DT_RowIndex')
                ->title('STT')
                ->exportable(false)
                ->printable(false)
                ->width(30)
                ->addClass('text-center'),
            Column::make('tentour')->width(250)->title('Tên tour'),
            Column::make('thoigiandi')->width(100)->title('Thời gian đi'),
            Column::make('giatour')->width(150)->title('Giá (VND)'),
            Column::make('maloaitour')->width(200)->title('Tên loại'),
            Column::make('tinhtrang')->width(100)->title('Tình trạng'),
            Column::make('hinhdaidien')->width(200)->title('Hình ảnh'),
            Column::make('noikhoihanh')->width(150)->title('Nơi khởi hành'),
            Column::make('makhuyenmai')->width(50)->title('Khuyến mãi'),
            // Column::make('created_at')->width(150)->title('Ngày tạo'),
            // Column::make('updated_at')->width(150)->title('Ngày cập nhật'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(500)
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
