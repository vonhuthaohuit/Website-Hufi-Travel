<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\PhieuDatTour;
use App\Models\PhieuHuyTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PhieuHuyController extends Controller
{
    public function cancelTour(Request $request)
    {
        $request->validate([
            'matour' => 'required|exists:tour,matour',
            'maphieudattour' => 'required|exists:phieudattour,maphieudattour',
            'lydohuy' => 'required'
        ]);

        $user = Session::get('user');
        @$maTaiKhoan = $user['mataikhoan'];
        $khachHang = KhachHang::where('mataikhoan', $maTaiKhoan)->first();
        if (!$khachHang) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin khách hàng.');
        }

        $phieuDatTour = PhieuDatTour::query()
            ->join('chitietphieudattour', 'phieudattour.maphieudattour', '=', 'chitietphieudattour.maphieudattour')
            ->where('phieudattour.maphieudattour', $request->maphieudattour)
            ->where('chitietphieudattour.nguoidat', $khachHang->makhachhang)
            ->first();

        if (!$phieuDatTour) {
            return redirect()->back()->with('error', 'Lỗi trong quá trình hủy tour!');
        } else {
            $phieuDatTour->trangthaidattour = 'Đã hủy';
            $phieuDatTour->save();
        }

        $phieuhuy = new PhieuHuyTour();
        $phieuhuy->lydohuy = $request->lydohuy;
        $phieuhuy->ngayhuy = today()->format('Y-m-d');

        $phieuhuy->save();

        $maphieuhuytour = $phieuhuy->maphieuhuytour;

        HoaDon::where('maphieudattour', $request->maphieudattour)
            ->update(['maphieuhuytour' => $maphieuhuytour]);

        return redirect()->route('tour.tour-booked')->with('success', 'Tour đã được hủy thành công.');
    }
}
