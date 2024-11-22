<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogTour;
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
            ->select('tour.*')
            ->where('tour.tinhtrang', 1)
            ->where('khuyenmai.thoigianketthuc', '>', now())
            ->get();

        // dd($destinations);

        return view("index", compact('tours', 'blogs', 'destinations', 'tourDiscount'));
    }

    public function about()
    {
        return view('frontend.home.about');
    }

    public function contact()
    {
        return view('frontend.home.contact');
    }

    public function transaction()
    {
        $user = Session::get('user');
        $maTaiKhoan = $user['mataikhoan'];

        $toursDaDat = PhieuDatTour::query()
            ->leftJoin('tour', 'phieudattour.matour', '=', 'tour.matour')
            ->leftJoin('chitietphieudattour', 'phieudattour.maphieudattour', '=', 'chitietphieudattour.maphieudattour')
            ->leftJoin('khachhang', 'chitietphieudattour.makhachhang', '=', 'khachhang.makhachhang')
            ->leftJoin('users', 'khachhang.mataikhoan', '=', 'users.mataikhoan')
            ->where('users.mataikhoan', $maTaiKhoan)
            ->select('tour.*', 'phieudattour.trangthaidattour')
            ->groupBy('phieudattour.maphieudattour')
            ->get();

        // dd($toursDaDat);

        return view('frontend.home.transactions', compact('toursDaDat'));
    }
}
