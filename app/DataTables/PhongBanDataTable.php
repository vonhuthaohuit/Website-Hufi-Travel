<?php

namespace App\DataTables;

use App\Models\PhongBan;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class PhongBanDataTable extends DataTable
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
                $editBtn = "<a href='" . route('phongban.edit', $query->maphongban) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('phongban.destroy', $query->maphongban) . "' class='btn btn-danger ml-2 delete-item' data-id='{$query->maphongban}'><i class='far fa-trash-alt'></i></a>";
                return $editBtn . $deleteBtn;
            })
            ->editColumn('created_at', function ($query) {
                return Carbon::parse($query->created_at)->format('d-m-Y'); // Định dạng ngày
            })
            ->addColumn('truongphong', function ($query) {
                // Nếu truongphong đã là đối tượng, sử dụng luôn
                if (is_object($query->truongphong)) {
                    return $query->truongphong->hoten;
                }

                // Nếu truongphong là ID, tìm đối tượng
                $truongphong = \App\Models\NhanVien::find($query->truongphong);

                // Trả về họ tên trưởng phòng nếu có, nếu không trả về 'Chưa có trưởng phòng'
                return $truongphong ? $truongphong->hoten : 'Chưa có trưởng phòng';
            })





            ->editColumn('updated_at', function ($query) {
                return Carbon::parse($query->updated_at)->format('d-m-Y'); // Định dạng ngày
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PhongBan $model): QueryBuilder
    {
        return $model->newQuery()->with('truongphong');  // Nạp mối quan hệ truongphong
    }



    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('phongban-table')
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
            Column::make('tenphongban')->width(100)->title('Tên phòng ban'),
            Column::make('truongphong')->width(100)->title('Tên trưởng phòng'),
            Column::make('created_at')->width(100)->title('Ngày tạo'),
            Column::make('updated_at')->width(100)->title('Cập nhật lần cuối'),
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
        return 'PhongBan_' . date('YmdHis');
    }
}
