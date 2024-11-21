<?php

namespace App\Http\Controllers\dattour;

use App\Http\Controllers\Controller;
use App\Http\Controllers\thanhtoan\PhieuDatTourController;
use App\Http\Controllers\thanhtoan\ThanhToanController;
use App\Models\ChiTietTour;
use App\Models\ChuongTrinhTour;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\KhachSan_Tour;
use App\Models\LoaiKhachHang;
use App\Models\PhieuDatTour;
use App\Models\PhuongTien_Tour;
use App\Models\Tour;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatTourController extends Controller
{
    protected $tour;
    protected $chitiettour;
    protected $chuongtrinhtour;
    protected $khachsan_tour;
    protected $phuongtien_tour;
    protected $khachHangs;
    protected $loaiKhachHangs;
    protected $phieuDatTour;
    protected $chiTietPhieuDatTour;

    public function __construct()
    {
        $this->tour = new Tour();
        $this->chitiettour = new ChiTietTour();
        $this->chuongtrinhtour = new ChuongTrinhTour();
        $this->khachsan_tour = new KhachSan_Tour();
        $this->phuongtien_tour = new PhuongTien_Tour();
        $this->khachHangs = new KhachHang();
        $this->loaiKhachHangs = new LoaiKhachHang();
        $this->phieuDatTour = new PhieuDatTourController();
        $this->chiTietPhieuDatTour = new PhieuDatTourController();
    }
    public function TinhGiaTourLoaiKhachHang($tourid)
    {
        $tour = $this->tour->find($tourid);

        if (!$tour) {
            return [];
        }

        $loaiKhachHang = $this->loaiKhachHangs->get();

        $giaTour_LoaiKhachHang = [];

        foreach ($loaiKhachHang as $index => $item) {
            $giaTour_LoaiKhachHang[$index] = round($tour->giatour - ($tour->giatour * ($item->mucapdunggia / 100)));
        }

        return $giaTour_LoaiKhachHang;
    }
    public function index(Request $request)
    {

        /*
        |--------------------------------------------------------------------------
        | Kiểm tra đăng nhập
        |--------------------------------------------------------------------------
        */
        if (Session::get('user') == null) {
            return redirect()->route('login');
        }
        $user = Session::get('user');
        $maTaiKhoan = $user['mataikhoan'];
        /*
        |--------------------------------------------------------------------------
        | Kiểm tra phương thức request có hay không
        |--------------------------------------------------------------------------
        */
        if ($request->isMethod('post')) {
            $tourId = $request->input('tourid');
            $loaiKhachHang = $this->loaiKhachHangs->get();
            $khachHang = $this->khachHangs->where('mataikhoan', $maTaiKhoan)->first();
            $tour = $this->tour->find($tourId);
            $giaTour_LoaiKhachHang = [];
            // Tính giá tour theo từng loại khách hàng
            $giaTour_LoaiKhachHang = $this->TinhGiaTourLoaiKhachHang($tourId);

            if (!$tour) {
                return redirect()->back()->withErrors('Tour not found.');
            }

            return view('frontend.dattour.dattour', compact('user', 'tour', 'loaiKhachHang', 'khachHang', 'giaTour_LoaiKhachHang'));
        }

        return redirect()->back()->withErrors('Invalid request method.');
    }

    public function xacnhanthongtindattour(Request $request)
    {
        if (Session::get('user') == null) {
            return redirect()->route('login');
        }

        $user = Session::get('user');
        $maTaiKhoan = $user['mataikhoan'];
        $khachHang = $this->khachHangs->where('mataikhoan', $maTaiKhoan)->first();
        $tourId = $request->input('tourId');
        if (!$tourId) {
            return redirect()->back()->with('error', 'Tour ID không hợp lệ.');
        }
        $tour = $this->tour->find($tourId);
        $data = [
            'tourId' => $tourId,
            'ticket_fullname' => $request->input('ticket_fullname'),
            'ticket_address' => $request->input('ticket_address'),
            'ticket_phone' => $request->input('ticket_phone'),
            'ticket_email' => $request->input('ticket_email'),
            'ticket_tendonvi' => $request->input('ticket_tendonvi'),
            'ticket_masothue' => $request->input('ticket_masothue'),
            'ticket_note' => $request->input('ticket_note'),
            'ticket_total_customer' => count($request->input('td_ticket', [])),
            'td_ticket' => $request->input('td_ticket', []),
            'payment_id' => $request->input('payment_id'),
        ];
        $thongTinNguoiDaiDien = [];
        $thongTinNguoiDaiDien['makhachhang'] = $khachHang->makhachhang;
        $thongTinNguoiDaiDien['nguoidaidien'] = $data['ticket_fullname'];
        $thongTinNguoiDaiDien['tendonvi'] = $data['ticket_tendonvi'];
        $thongTinNguoiDaiDien['diachidonvi'] = $data['ticket_address'];
        $thongTinNguoiDaiDien['masothue'] = $data['ticket_masothue'];

        $khachHang->hoten = $data['ticket_fullname'];
        $khachHang->diachi = $data['ticket_address'];
        $khachHang->sodienthoai = $data['ticket_phone'];
        $user->email = $data['ticket_email'];
        $khachHang->save();

        session()->put('thongTinNguoiDaiDien', $thongTinNguoiDaiDien);
        $tongTienPhieuDatTour = 0;
        $tongSoLuong = $data['ticket_total_customer'];
        $danhSachKhachHangDiTour = new Collection();

        foreach ($data['td_ticket'] as $key => $value) {
            $khachHangDiTour = KhachHang::create([
                'hoten' => $value['td_name'],
                'ngaysinh' => $value['td_birthday'],
                'gioitinh' => $value['td_gender'],
                'maloaikhachhang' => $value['td_loaikhach'],
            ]);
            $danhSachKhachHangDiTour->push($khachHangDiTour);
            $tongTienPhieuDatTour += $value['td_price'];
        }

        $trangThaiDatTour = 'Đang chờ xác nhận đặt tour';
        $toDay = date('Y-m-d');
        $phieuDatTour = $this->phieuDatTour->TaoPhieuDatTour($tourId, $tongTienPhieuDatTour, $tongSoLuong, $trangThaiDatTour, $toDay);
        if (!$phieuDatTour || !isset($phieuDatTour['maphieudattour'])) {
            return redirect()->back()->with('error', 'Không thể tạo phiếu đặt tour.');
        }



        // Tạo danh sách khách hàng đi tour
        foreach ($data['td_ticket'] as $key => $value) {
            $chiTietSoTienDat = $value['td_price'];
            $this->chiTietPhieuDatTour->TaoChiTietPhieuDatTour(
                $danhSachKhachHangDiTour[$key - 1]->makhachhang,
                $phieuDatTour['maphieudattour'],
                $chiTietSoTienDat,
                $thongTinNguoiDaiDien['makhachhang']
            );
        }
        return view('frontend.dattour.xacnhanthongtindattour', compact('data', 'tour', 'phieuDatTour'));
    }
    public function tieptucdattour(Request $request)
    {
        $data = $request->all();
        $phieuDatTour = \App\Models\PhieuDatTour::find($data['phieuDatTourid']);
        $trangThaiDatTour = 'Đang chờ xác nhận đặt tour';
        $phuongThucThanhToan = 'Thanh toán trực tiếp';
        $thongTinNguoiDaiDien = session('thongTinNguoiDaiDien');
        DB::beginTransaction();
        try {
            HoaDon::create([
                'maphieudattour' => $phieuDatTour->maphieudattour,
                'tongsotien' => $phieuDatTour->tongtienphieudattour,
                'phuongthucthanhtoan' => $phuongThucThanhToan,
                'trangthaithanhtoan' => $trangThaiDatTour,
                'nguoidaidien' => $thongTinNguoiDaiDien['nguoidaidien'] ?? null,
                'tendonvi' => $thongTinNguoiDaiDien['tendonvi'] ?? null,
                'diachidonvi' => $thongTinNguoiDaiDien['diachidonvi'] ?? null,
                'masothue' => $thongTinNguoiDaiDien['masothue'] ?? null,
            ]);

            DB::commit();
            return view('frontend/thanhtoan/payment_success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Lỗi trong quá trình lưu hóa đơn: " . $e->getMessage());
            return view('frontend/thanhtoan/payment_failed');
        }
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
