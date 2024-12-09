<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogTour;
use App\Models\ChiTietPhieuDatTour;
use App\Models\ChiTietTour;
use App\Models\DiemDuLich;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\LoaiBlog;
use App\Models\PhieuDatTour;
use App\Models\PhieuHuyTour;
use App\Models\Tour;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    use ImageUploadTrait;
    protected $chiTietPhieuDatTour;
    public function __construct()
    {
        $this->chiTietPhieuDatTour = new ChiTietPhieuDatTour();
    }
    public function index()
    {
        $tours = Tour::with('chitiettour.giachitiettour', 'hinhanhtour:tenhinh,duongdan');
        $blogs = BlogTour::where('trangthaiblog', 1)
            ->orderBy('mablogtour', 'DESC')->take(3)->get();

        $destinations = DiemDuLich::query()
            ->select('diemdulich.tendiemdulich', DB::raw('COUNT(*) AS total_tours'))
            ->join('chitiettour', 'diemdulich.madiemdulich', '=', 'chitiettour.madiemdulich')
            ->join('tour', 'chitiettour.matour', '=', 'tour.matour')
            ->groupBy('diemdulich.madiemdulich', 'diemdulich.tendiemdulich')
            ->orderByDesc('total_tours')
            ->limit(5)
            ->get();

        $tourDiscount = Tour::query()
            ->leftJoin('khuyenmai', 'tour.makhuyenmai', '=', 'khuyenmai.makhuyenmai')
            ->leftJoin('danhgia', 'tour.matour', '=', 'danhgia.matour')
            ->select('tour.*', DB::raw('AVG(danhgia.diemdanhgia) as avg_rating'), DB::raw('COUNT(danhgia.madanhgia) as review_count'), 'khuyenmai.phantramgiam')
            ->where('tour.tinhtrang', 1)
            ->where('khuyenmai.thoigianketthuc', '>', now())
            ->groupBy('tour.matour')
            ->get();

        $nearestFutureDate = collect($tourDiscount)
            ->pluck('khuyenmai.thoigianketthuc')
            ->filter(fn($date) => Carbon::parse($date)->isFuture())
            ->sort()
            ->first();

        return view("index", compact('tours', 'blogs', 'destinations', 'tourDiscount', 'nearestFutureDate'));
    }

    public function about()
    {
        return view('frontend.home.about');
    }

    public function contact()
    {
        return view('frontend.home.contact');
    }

    public function transaction($trangThai = null)
    {
        $user = Session::get('user');
        @$maTaiKhoan = $user['mataikhoan'];
        $khachHang = KhachHang::where('mataikhoan', $maTaiKhoan)->first();
        if (!$khachHang) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin khách hàng.');
        }

        $tours = ChiTietPhieuDatTour::where('nguoidat', $khachHang->makhachhang)
            ->whereHas('phieuDatTour', function ($query) use ($trangThai) {
                if ($trangThai) {
                    $query->where('trangthai', $trangThai);
                }
                $query->whereIn('trangthaidattour', ['Đang chờ xác nhận đặt tour', 'Chưa thanh toán']);
            })
            ->with(['phieuDatTour.tour'])
            ->groupBy('maphieudattour')
            ->orderBy('maphieudattour', 'desc')
            ->get();

        return view('frontend.home.transactions', compact('tours'));
    }

    public function tourOrder($matour, $maphieudattour = null, $trangThai = null)
    {
        $user = Session::get('user');
        @$maTaiKhoan = $user['mataikhoan'];
        $khachHang = KhachHang::where('mataikhoan', $maTaiKhoan)->first();
        if (!$khachHang) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin khách hàng.');
        }

        $tour = ChiTietPhieuDatTour::where('nguoidat', $khachHang->makhachhang)
            ->where('maphieudattour', $maphieudattour)
            ->whereHas('phieuDatTour', function ($query) use ($trangThai) {
                if ($trangThai) {
                    $query->where('trangthai', $trangThai);
                }
            })
            ->whereHas('phieuDatTour.tour', function ($query) use ($matour) {
                $query->where('matour', $matour);
            })
            ->with(['phieuDatTour.tour'])
            ->first();

        @$hoadon = HoaDon::where('maphieudattour', $tour->phieuDatTour->maphieudattour)->first();

        @$soLuongKhach = HoaDon::query()
            ->leftJoin('phieudattour', 'hoadon.maphieudattour', '=', 'phieudattour.maphieudattour')
            ->leftJoin('chitietphieudattour', 'phieudattour.maphieudattour', '=', 'chitietphieudattour.maphieudattour')
            ->leftJoin('khachhang', 'chitietphieudattour.makhachhang', '=', 'khachhang.makhachhang')
            ->leftJoin('loaikhachhang', 'khachhang.maloaikhachhang', '=', 'loaikhachhang.maloaikhachhang')
            ->select('hoadon.mahoadon', 'khachhang.hoten', 'khachhang.ngaysinh', 'khachhang.gioitinh', 'loaikhachhang.tenloaikhachhang')
            ->where('mahoadon', $hoadon->mahoadon)
            ->get();

        $thongTinNguoiDaiDien = [];
        $thongTinNguoiDaiDien['makhachhang'] = $khachHang->makhachhang;
        $thongTinNguoiDaiDien['nguoidaidien'] = $khachHang->hoten;
        $thongTinNguoiDaiDien['tendonvi'] = $hoadon->tendonvi ?? null;
        $thongTinNguoiDaiDien['diachidonvi'] = $khachHang->diachi ?? null;
        $thongTinNguoiDaiDien['masothue'] = $hoadon->masothue ?? null;
        $thongTinNguoiDaiDien['email'] = $user->email ?? null;
        session()->put('thongTinNguoiDaiDien', $thongTinNguoiDaiDien);

        @$phieuhuy = PhieuHuyTour::where('maphieuhuytour', $hoadon->maphieuhuytour)->first();

        @$ngayketthuc = ChiTietTour::where('matour', $matour)
            ->where('ngaybatdau', '=', $tour->phieuDatTour->ngaybatdau)
            ->first();

        return view('frontend.home.tour-order', compact('soLuongKhach', 'tour', 'khachHang', 'user', 'phieuhuy', 'ngayketthuc'));
    }

    public function tourBooked($trangThai = null)
    {
        $user = Session::get('user');
        @$maTaiKhoan = $user['mataikhoan'];
        $khachHang = KhachHang::where('mataikhoan', $maTaiKhoan)->first();
        if (!$khachHang) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin khách hàng.');
        }

        $tours = ChiTietPhieuDatTour::where('nguoidat', $khachHang->makhachhang)
            ->whereHas('phieuDatTour', function ($query) use ($trangThai) {
                if ($trangThai) {
                    $query->where('trangthai', $trangThai);
                }
                $query->where('trangthaidattour', 'Đã thanh toán');
            })
            ->with(['phieuDatTour.tour'])
            ->groupBy('maphieudattour')
            ->orderBy('maphieudattour', 'desc')
            ->get();

        return view('frontend.home.tour-booked', compact('tours'));
    }

    public function tourCanceled($trangThai = null)
    {
        $user = Session::get('user');
        @$maTaiKhoan = $user['mataikhoan'];
        $khachHang = KhachHang::where('mataikhoan', $maTaiKhoan)->first();
        if (!$khachHang) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin khách hàng.');
        }

        $tours = ChiTietPhieuDatTour::where('nguoidat', $khachHang->makhachhang)
            ->whereHas('phieuDatTour', function ($query) use ($trangThai) {
                if ($trangThai) {
                    $query->where('trangthai', $trangThai);
                }
                $query->where('trangthaidattour', 'Đã hủy');
            })
            ->with(['phieuDatTour.tour'])
            ->groupBy('maphieudattour')
            ->orderBy('maphieudattour', 'desc')
            ->get();

        return view('frontend.home.tour-canceled', compact('tours'));
    }

    public function profile()
    {
        $user = Session::get('user');
        $mataikhoan = $user['mataikhoan'];
        $khachhang = KhachHang::where('mataikhoan', $mataikhoan)->first();

        return view('frontend.home.profile', compact('user', 'khachhang'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'hoten' => 'required',
            'ngaysinh' => 'required',
            'gioitinh' => 'required',
            'sodienthoai' => 'required',
            'diachi' => 'required',
            // 'hinhdaidien' => 'nullable|image'
        ]);

        $user = Session::get('user');
        $mataikhoan = $user['mataikhoan'];
        $khachhang = KhachHang::where('mataikhoan', $mataikhoan)->first();
        $khachhang->hoten = $request->hoten;
        $khachhang->ngaysinh = $request->ngaysinh;
        $khachhang->gioitinh = $request->gioitinh;
        $khachhang->sodienthoai = $request->sodienthoai;
        $khachhang->diachi = $request->diachi;

        $khachhang->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }
}
