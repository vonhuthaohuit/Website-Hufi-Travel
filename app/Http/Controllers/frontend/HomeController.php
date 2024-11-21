<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogTour;
use App\Models\ChiTietPhieuDatTour;
use App\Models\DiemDuLich;
use App\Models\KhachHang;
use App\Models\LoaiBlog;
use App\Models\PhieuDatTour;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
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

        // dd($destinations);

        return view("index", compact('tours', 'blogs', 'destinations'));
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
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem các giao dịch.');
        }

        $maTaiKhoan = $user['mataikhoan'];
        $khachHang = KhachHang::where('mataikhoan', $maTaiKhoan)->first();
        if (!$khachHang) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin khách hàng.');
        }

        $tours = \App\Models\ChiTietPhieuDatTour::where('nguoidat', $khachHang->makhachhang)
            ->whereHas('phieuDatTour', function ($query) use ($trangThai) {
                if ($trangThai) {
                    $query->where('trangthai', $trangThai);
                }
            })
            ->with(['phieuDatTour.tour'])
            ->groupBy('maphieudattour')
            ->orderBy('maphieudattour', 'desc')
            ->get();
        return view('frontend.home.transactions', compact('tours'));
    }
}
