<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BlogTour;
use App\Models\KhachHang;
use App\Models\NhanVien;
use App\Models\Tour;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        return view('backend.dashboard.index', compact('totalUsers', 'totalBlogs', 'totalTour', 'totalMoneyInDay', 'totalMoneyInMonth', 'totalMoneyInYear', 'phieuHuy'));
    }

    public function profile()
    {
        $user =  Session('user');
        $mataikhoan = $user['mataikhoan'];
        $khachhang = NhanVien::where('mataikhoan', $mataikhoan)->first();
        return view('backend.dashboard.profile',compact('user', 'khachhang'));
    }

    public function updateProfile(Request $request)
    {

        try {

            $request->validate([
                'hoten' => 'required',
                'ngaysinh' => 'required',
                'gioitinh' => 'required',
                'sodienthoai' => 'required',
                'bangcap' => 'required',
                // 'hinhdaidien' => 'nullable|image'
            ]);
            $user =  Session('user');
            $user = User::findOrFail($user->mataikhoan);
            $user->email = $request->email;
            $user->save();
            $mataikhoan = $user['mataikhoan'];
            $khachhang = NhanVien::where('mataikhoan', $mataikhoan)->first();

            $khachhang->hoten = $request->hoten;
            $khachhang->ngaysinh = $request->ngaysinh;
            $khachhang->gioitinh = $request->gioitinh;
            $khachhang->sodienthoai = $request->sodienthoai;
            $khachhang->bangcap = $request->bangcap;
            $khachhang->save();

            return redirect()->route('ad.profile')->with('success', 'Cập nhật thông tin thành công');
        } catch (Exception $e) {
            Log::error('Error in registration process:', ['error' => $e->getMessage()]);
            return redirect()->route('ad.profile')->with('error', 'Cập nhật thông tin không thành công');

        }
    }
}
