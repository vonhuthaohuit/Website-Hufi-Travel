<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BlogTour;
use App\Models\KhachHang;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $totalUsers = KhachHang::count();
        $totalBlogs = BlogTour::count();
        $totalTour = Tour::count();
        $totalMoneyInDay = DB::select('SELECT func_tongTienTrongNgay() AS tongTien');
        $totalMoneyInDay = $totalMoneyInDay[0]->tongTien ?? 0;
        $totalMoneyInMonth = DB::select('SELECT func_tongTienTrongThang() AS tongTien');
        $totalMoneyInMonth = $totalMoneyInMonth[0]->tongTien ?? 0;
        $totalMoneyInYear = DB::select('SELECT func_tongTienTrongNam() AS tongTien');
        $totalMoneyInYear = $totalMoneyInYear[0]->tongTien ?? 0;
        $phieuHuy = DB::select('SELECT func_soPhieuHuy() AS phieuHuy');
        $phieuHuy = $phieuHuy[0]->phieuHuy ?? 0;
        return view('backend.dashboard.index', compact('totalUsers', 'totalBlogs', 'totalTour', 'totalMoneyInDay','totalMoneyInMonth','totalMoneyInYear','phieuHuy'));
    }
}
