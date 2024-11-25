<?php

namespace App\DataTables;

use App\Models\NhanVien;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class NhanVienDataTable extends DataTable
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
                $editBtn = "<a href='" . route('nhanvien.edit', $query->manhanvien) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('nhanvien.destroy', $query->manhanvien) . "' class='btn btn-danger ml-2 delete-item' data-id='{$query->manhanvien}'><i class='far fa-trash-alt'></i></a>";
                $moreBtn = '<div class="dropdown dropleft d-inline">
             <button class="btn btn-primary dropdown-toggle ml-1" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
            </button>
            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
               <a class="dropdown-item has-icon" href="' . route('phancongchucvu.index', ['manhanvien' => $query->manhanvien]) . '" ><i class="far fa-heart"></i>Phân công chức vụ</a>
               </div>
          </div>';
                return $editBtn . $deleteBtn . $moreBtn;
            })
            ->editColumn('ngayvaolam', function ($query) {
                return Carbon::parse($query->ngayvaolam)->format('d-m-Y'); // Định dạng ngày
            })
            ->addColumn('maphongban', function ($query) {
                return $query->phongban->tenphongban;
            })
            ->addColumn('manhomquyen', function ($query) {
                return $query->user && $query->user->nhomquyen ? $query->user->nhomquyen->tennhomquyen : 'Chưa có quyền';
            })

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(NhanVien $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('user.nhomquyen');  // Thêm eager loading cho mối quan hệ users và nhomquyen
    }


    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('nhanvien-table')
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
            Column::make('hoten')->width(150)->title('Họ và Tên'),
            Column::make('gioitinh')->width(100)->title('Giới tính'),
            Column::make('sodienthoai')->width(150)->title('Liên lạc'),
            Column::make('ngayvaolam')->width(120)->title('Ngày vào làm'),
            Column::make('manhomquyen')->width(150)->title('Quyền'),
            Column::make('maphongban')->width(150)->title('Phòng ban'),
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
        return 'NhanVien_' . date('YmdHis');
    }
}
