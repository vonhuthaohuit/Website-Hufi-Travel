<?php

namespace App\Http\Controllers\dattour;

use App\Http\Controllers\Controller;
use App\Models\ChiTietTour;
use App\Models\ChuongTrinhTour;
use App\Models\KhachHang;
use App\Models\KhachSan_Tour;
use App\Models\LoaiKhachHang;
use App\Models\PhuongTien_Tour;
use App\Models\Tour;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DatTourController extends Controller
{
    protected $tour;
    protected $chitiettour;
    protected $chuongtrinhtour;
    protected $khachsan_tour;
    protected $phuongtien_tour;
    protected $khachHangs;
    protected $loaiKhachHangs;

    public function __construct()
    {
        // Khởi tạo các model liên quan
        $this->tour = new Tour();
        $this->chitiettour = new ChiTietTour();
        $this->chuongtrinhtour = new ChuongTrinhTour();
        $this->khachsan_tour = new KhachSan_Tour();
        $this->phuongtien_tour = new PhuongTien_Tour();
        $this->khachHangs = new KhachHang();
        $this->loaiKhachHangs = new LoaiKhachHang();
    }

    public function index(Request $request)
    {

        /*
        |--------------------------------------------------------------------------
        | Kiểm tra đăng nhập
        |--------------------------------------------------------------------------
        */

        // if (!Auth::check()) {
        //     return redirect()->route('login_view');
        // }
        // $user = Session::get('user');
        // $maTaiKhoan = $user->maTaiKhoan;
        // $khachHang = $this->khachHangs->where('mataikhoan', $maTaiKhoan)->first();
        /*
        |--------------------------------------------------------------------------
        | Kiểm tra phương thức request có hay không
        |--------------------------------------------------------------------------
        */
        if ($request->isMethod('post')) {
            $tourId = $request->input('tourid');
            $loaiKhachHang = $this->loaiKhachHangs->get();
            $khachHang = $this->khachHangs->where('mataikhoan', 1)->first();
            $tour = $this->tour->with(['chitiettour', 'chuongtrinhtour'])
                ->find($tourId);

            $giaTour_LoaiKhachHang = [];
            // Tính giá tour theo từng loại khách hàng
            foreach($loaiKhachHang as $index => $item) {
                $giaTour_LoaiKhachHang[$index] = $tour->giatour * ($item->mucapdunggia / 100);
            }


            if (!$tour) {
                return redirect()->back()->withErrors('Tour not found.');
            }

            return view('frontend.dattour.dattour', compact('tour', 'loaiKhachHang', 'khachHang', 'giaTour_LoaiKhachHang'));
        }

        return redirect()->back()->withErrors('Invalid request method.');
    }

    public function xacnhanthongtindattour(Request $request)
    {
        $data = $request->all();

        $tourId = $request->input('tourId');
        $nguoiDaiDien = [
            'fullname' => $request->input('ticket_fullname'),
            'address' => $request->input('ticket_address'),
            'phone' => $request->input('ticket_phone'),
            'email' => $request->input('ticket_email'),
        ];
        $phuongThucThanhToan = $request->input('payment_id');

        $customers = $request->input('td_ticket');

        return view(
            'frontend.dattour.xacnhanthongtindattour',
            compact('nguoiDaiDien', 'customers', 'tourId', 'phuongThucThanhToan')
        );
    }

    public function create()
    {
        // Logic tạo mới
    }

    public function store(Request $request)
    {
        // Logic lưu dữ liệu
    }

    public function show(string $id)
    {
        // Logic hiển thị thông tin chi tiết
    }

    public function edit(string $id)
    {
        // Logic sửa dữ liệu
    }

    public function update(Request $request, string $id)
    {
        // Logic cập nhật dữ liệu
    }

    public function destroy(string $id)
    {
        // Logic xóa dữ liệu
    }
}
