<?php

namespace App\Http\Controllers\thanhtoan;

use App\DataTables\HoaDonDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\dattour\DatTourController;
use App\Mail\ThanhToanThanhCong;
use App\Models\ChiTietPhieuDatTour;
use App\Models\ChiTietTour;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\LoaiKhachHang;
use App\Models\PhieuDatTour;
use App\Models\Tour;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HoaDonController extends Controller
{
    protected $hoaDon;
    protected $datTourController;
    protected $phieuDatTourController;
    protected $chiTietPhieuDatTourController;
    public function __construct()
    {
        $this->hoaDon = new HoaDon();
        $this->datTourController = new DatTourController();
        $this->phieuDatTourController = new PhieuDatTourController();
        $this->chiTietPhieuDatTourController = new PhieuDatTourController();
    }
    public function index(HoaDonDataTable $dataTable)
    {
        if (Session::get("user") == null) {
            return redirect()->route('login');
        }

        return $dataTable->render("backend.hoadon.index");
    }


    public function TaoHoaDon($phieuDatTour, $thongTinNguoiDatTour, $tongSoTien, $phuongThucThanhToan, $trangThaiThanhToan)
    {

        HoaDon::create([
            'phieuDatTour' => $phieuDatTour,
            'tongsotien' => $tongSoTien,
            'phuongthucthanhtoan' => $phuongThucThanhToan,
            'trangthaithanhtoan' => $trangThaiThanhToan,
            'nguoidaidien' => $thongTinNguoiDatTour->nguoiDaiDien ?? null,
            'tendonvi' => $thongTinNguoiDatTour->tendonvi ?? null,
            'diachidonvi' => $thongTinNguoiDatTour->diachi ?? null,
            'masothue' => $thongTinNguoiDatTour->maSoThue ?? null,
        ]);
    }
    public function XoaHoaDon($id)
    {
        $hoaDon = HoaDon::find($id);

        if ($hoaDon) {
            $hoaDon->delete();
            return response()->json(['message' => 'Hóa đơn đã được xoá thành công.']);
        } else {
            return response()->json(['message' => 'Không tìm thấy hóa đơn.'], 404);
        }
    }
    public function SuaHoaDon(Request $request, $id)
    {
        $hoaDon = HoaDon::find($id);

        if ($hoaDon) {
            $hoaDon->update([
                'phieuDatTour' => $request->phieuDatTour ?? $hoaDon->phieuDatTour,
                'tongsotien' => $request->tongSoTien ?? $hoaDon->tongsotien,
                'phuongthucthanhtoan' => $request->phuongThucThanhToan ?? $hoaDon->phuongthucthanhtoan,
                'trangthaithanhtoan' => $request->trangThaiThanhToan ?? $hoaDon->trangthaithanhtoan,
                'nguoidaidien' => $request->nguoiDaiDien ?? $hoaDon->nguoidaidien,
                'tendonvi' => $request->tenDonVi ?? $hoaDon->tendonvi,
                'diachidonvi' => $request->diaChiDonVi ?? $hoaDon->diachidonvi,
                'masothue' => $request->maSoThue ?? $hoaDon->masothue,
            ]);

            return response()->json(['message' => 'Hóa đơn đã được cập nhật thành công.']);
        } else {
            return response()->json(['message' => 'Không tìm thấy hóa đơn.'], 404);
        }
    }
    public function TimKiemHoaDon(Request $request)
    {
        $query = HoaDon::query();

        if ($request->has('phieuDatTour')) {
            $query->where('phieuDatTour', $request->phieuDatTour);
        }

        if ($request->has('trangThaiThanhToan')) {
            $query->where('trangthaithanhtoan', $request->trangThaiThanhToan);
        }

        $hoaDons = $query->get();

        return response()->json($hoaDons);
    }
    public function create()
    {
        $tours = Tour::all();
        $users = User::all();



        return view('frontend.thanhtoan.taohoadon', compact('tours', 'users'));
    }
    private function generateUsername($fullname)
    {
        $username = Str::slug($fullname, '');

        return $username;
    }
    public function store(Request $request)
    {
        $user = null;
        $khachHang = null;
        DB::beginTransaction();
        try {
            if ($request['user_id'] == null) {
                $username = $this->generateUsername($request['ticket_fullname']);

                while (User::where('tentaikhoan', $username)->exists()) {
                    $username = $this->generateUsername($request['ticket_fullname']) . rand(0, 100000);
                }

                $user = User::create([
                    'tentaikhoan' => $username,
                    'email' => $request['ticket_email'],
                    'matkhau' => bcrypt('123456789'),
                    'trangthai' => 'Hoạt động',
                    'manhomquyen' => 2,
                ]);
                $khachHang = KhachHang::create([
                    'mataikhoan' => $user->mataikhoan,
                    'cccd' => $request['ticket_cccd'],
                    'hoten' => $request['ticket_fullname'],
                    'sodienthoai' => $request['ticket_phone'],
                    'diachi' => $request['ticket_address'],
                    'maloaikhachhang' => 1,
                ]);
                DB::commit();
            } else {
                $user = User::findOrFail($request['user_id']);

                $khachHang = KhachHang::updateOrCreate(
                    ['mataikhoan' => $user->mataikhoan],
                    [
                        'hoten' => $request['ticket_fullname'],
                        'cccd' => $request['ticket_cccd'],
                        'sodienthoai' => $request['ticket_phone'],
                        'diachi' => $request['ticket_address'],
                    ]
                );
                DB::commit();
            }



            $data = [
                'tourId' => $request['tour_id'],
                'ticket_ngaykhoihanh' => $request['ticket_ngaykhoihanh'],
                'ticket_fullname' => $request->input('ticket_fullname'),
                'ticket_address' => $request->input('ticket_address'),
                'ticket_phone' => $request->input('ticket_phone'),
                'ticket_email' => $request->input('ticket_email'),
                'ticket_tendonvi' => $request->input('ticket_tendonvi'),
                'ticket_masothue' => $request->input('ticket_masothue'),
                'ticket_note' => $request->input('ticket_note'),
                'ticket_total_customer' => count($request->input('td_ticket', [])),
                'td_ticket' => $request->input('td_ticket', []),
                'phuongthucthanhtoan' => $request->input('phuongthucthanhtoan'),
                //'trangthaithanhtoan' => $request->input('trangthaithanhtoan'),
            ];

            $thongTinNguoiDaiDien = [];
            $thongTinNguoiDaiDien['makhachhang'] = $khachHang->makhachhang;
            $thongTinNguoiDaiDien['nguoidaidien'] = $data['ticket_fullname'];
            $thongTinNguoiDaiDien['tendonvi'] = $data['ticket_tendonvi'];
            $thongTinNguoiDaiDien['diachidonvi'] = $data['ticket_address'];
            $thongTinNguoiDaiDien['masothue'] = $data['ticket_masothue'];
            $thongTinNguoiDaiDien['email'] = $data['ticket_email'];


            $tourId = $data['tourId'];
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

            $trangThaiDatTour = 'Đã thanh toán';
            $toDay = date('Y-m-d');
            $phieuDatTour = $this->phieuDatTourController->TaoPhieuDatTour($tourId, $tongTienPhieuDatTour, $tongSoLuong, $trangThaiDatTour, $toDay, $data['ticket_ngaykhoihanh']);
            if (!$phieuDatTour || !isset($phieuDatTour['maphieudattour'])) {
                return redirect()->back()->with('error', 'Không thể tạo phiếu đặt tour.');
            }

            foreach ($data['td_ticket'] as $key => $value) {
                $chiTietSoTienDat = $value['td_price'];
                $this->chiTietPhieuDatTourController->TaoChiTietPhieuDatTour(
                    $danhSachKhachHangDiTour[$key - 1]->makhachhang,
                    $phieuDatTour['maphieudattour'],
                    $chiTietSoTienDat,
                    $khachHang->makhachhang
                );
            }

            $phuongThucThanhToan = $data['phuongthucthanhtoan'];
            $hoaDon = HoaDon::create([
                'maphieudattour' => $phieuDatTour['maphieudattour'],
                'tongsotien' => $phieuDatTour['tongtienphieudattour'],
                'phuongthucthanhtoan' => $phuongThucThanhToan,
                'trangthaithanhtoan' => $trangThaiDatTour,
                'nguoidaidien' => $thongTinNguoiDaiDien['nguoidaidien'] ?? null,
                'tendonvi' => $thongTinNguoiDaiDien['tendonvi'] ?? null,
                'diachidonvi' => $thongTinNguoiDaiDien['diachidonvi'] ?? null,
                'masothue' => $thongTinNguoiDaiDien['masothue'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            try {
                Mail::to($thongTinNguoiDaiDien['email'])->send(new ThanhToanThanhCong($hoaDon));
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }

            DB::commit();
            return redirect()->route('hoadon.index')->with('success', 'Hóa đơn đã được tạo thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau.');
        }
    }


    public function edit($id)
    {
        $hoadon = HoaDon::with([
            'phieudattour.tour',
            'phieudattour.chitietphieudattour.khachhang'
        ])->findOrFail($id);

        return view('frontend.thanhtoan.suahoadon', compact('hoadon'));
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $hoadon = HoaDon::find($request->mahoadon);

            $hoadon->update([
                'tongsotien' => $request->tongsotien,
                'phuongthucthanhtoan' => $request->phuongthucthanhtoan,
                'trangthaithanhtoan' => $request->trangthaithanhtoan,
            ]);
            $phieuDatTour = $hoadon->phieudattour;
            $phieuDatTour->update([
                'trangthaidattour' => $request->trangthaithanhtoan,
                'tongtienphieudattour' => $request->tongsotien,
            ]);
            foreach ($request->khachhang as $value) {
                $chitietphieudattour = ChiTietPhieuDatTour::find($value['maphieudattour']);
                if ($chitietphieudattour) {
                    $chitietphieudattour->update(['chitietsotiendat' => $value['chitietsotiendat']]);
                    $loaiKhachHang = LoaiKhachHang::where('tenloaikhachhang', $value['tenloaikhachhang'])->first();
                    $khachHang = KhachHang::find($chitietphieudattour->makhachhang);
                    $khachHang->update([
                        'hoten' => $value['hoten'],
                        'cccd' => $value['cccd'],
                        'sodienthoai' => $value['sodienthoai'],
                        'ngaysinh' => $value['ngaysinh'],
                        'gioitinh' => $value['gioitinh'],
                        'maloaikhachhang' => $loaiKhachHang->maloaikhachhang,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
            DB::commit();

            return redirect()->route('hoadon.index')->with('success', 'Hóa đơn được cập nhật thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('hoadon.index')->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau.');
        }
    }


    public function getCustomerPrice($age, $tourId)
    {
        $datTourController = new DatTourController();
        $loaiKhachHang = LoaiKhachHang::all();
        $giaTheoLoaiKhachHang = $datTourController->TinhGiaTourLoaiKhachHang($tourId);

        if ($age < 5) {
            $loaiKhachHang = $loaiKhachHang->where('maloaikhachhang', 3)->first();
        } else if ($age >= 5 && $age < 18) {
            $loaiKhachHang = $loaiKhachHang->where('maloaikhachhang', 2)->first();
        } else {
            $loaiKhachHang = $loaiKhachHang->where('maloaikhachhang', 1)->first();
        }

        $price = $giaTheoLoaiKhachHang[$loaiKhachHang->maloaikhachhang - 1] ?? 0;

        return response()->json([
            'price' => $price,
            'customerType' => $loaiKhachHang->tenloaikhachhang,
        ]);
    }




    public function destroy($id)
    {
        $hoadon = HoaDon::find($id);

        if (!$hoadon) {
            return response(['status' => 'error', 'message' => 'Hóa đơn không tồn tại'], 404);
        }

        $hoadon->is_delete = 1;
        $hoadon->save();


        Log::info($hoadon);
        return response(['status' => 'success', 'message' => 'Xóa hoá đơn thành công']);
    }

    public function show($id)
    {
        $hoadon = HoaDon::with([
            'phieudattour.tour',
            'phieudattour.chitietphieudattour',
            'phieudattour.chitietphieudattour.khachhang'
        ])->findOrFail($id);

        $maKhachHang = $hoadon->phieudattour->chitietphieudattour->first()->nguoidat;
        $sodienthoai = 'N/A';
        foreach ($hoadon->phieudattour->chitietphieudattour as $chiTiet) {
            if ($chiTiet->nguoidat == $maKhachHang) {
                $sodienthoai = $chiTiet->khachhang->sodienthoai;
                break;
            }
        }
        Log::info($hoadon);
        $html = view('backend.hoadon.detailshoadon', compact('hoadon', 'sodienthoai'))->render();

        return response()->json(['html' => $html]);
    }
    public function printInvoice($hoaDonId)
    {
        $hoadon = HoaDon::with([
            'phieudattour.tour',
            'phieudattour.chitietphieudattour',
            'phieudattour.chitietphieudattour.khachhang'
        ])->findOrFail($hoaDonId);
        $maKhachHang = $hoadon->phieudattour->chitietphieudattour->first()->nguoidat;
        $sodienthoai = 'N/A';
        foreach ($hoadon->phieudattour->chitietphieudattour as $chiTiet) {
            if ($chiTiet->nguoidat == $maKhachHang) {
                $sodienthoai = $chiTiet->khachhang->sodienthoai;
                break;
            }
        }
        $pdf = PDF::loadView('backend.hoadon.inhoadon', compact('hoadon', 'sodienthoai'));

        return $pdf->download('hoa_don_' . $hoadon->mahoadon . '.pdf');
    }
    public function getChiTietTour($tourId)
    {
        $chitiettour = ChiTietTour::where('matour', $tourId)->get();
        return response()->json($chitiettour);
    }
}
