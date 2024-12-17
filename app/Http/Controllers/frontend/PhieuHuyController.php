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
            $phieuDatTour->trangthaidattour = 'Yêu cầu hủy tour';
            $phieuDatTour->save();
        }

        $phieuhuy = new PhieuHuyTour();
        $phieuhuy->lydohuy = $request->lydohuy;
        $phieuhuy->ngayhuy = today()->format('Y-m-d');
        $phieuhuy->save();

        $maphieuhuytour = $phieuhuy->maphieuhuytour;

        HoaDon::where('maphieudattour', $request->maphieudattour)
            ->update(['maphieuhuytour' => $maphieuhuytour]);

        // $tour = PhieuDatTour::query()
        //     ->join('tour', 'phieudattour.matour', '=', 'tour.matour')
        //     ->select('tour.giatour', 'phieudattour.ngaybatdau')
        //     ->where('phieudattour.maphieudattour', $request->maphieudattour)
        //     ->first();

        // if ($tour) {
        //     $ngayBatDau = \Carbon\Carbon::parse($tour->ngaybatdau);
        //     $ngayHuy = \Carbon\Carbon::parse($phieuhuy->ngayhuy);

        //     $soNgayTruocBatDau = $ngayHuy->diffInDays($ngayBatDau, false);

        //     $phanTramHoanTien = match (true) {
        //         $soNgayTruocBatDau > 30 => 1,
        //         $soNgayTruocBatDau >= 16 => 0.7,
        //         $soNgayTruocBatDau >= 8 => 0.3,
        //         $soNgayTruocBatDau >= 4 => 0.1,
        //         default => 0.0,
        //     };

        //     $soTienHoan = $tour->giatour * $phanTramHoanTien;

        //     $phieuhuy->sotienhoan = $soTienHoan;
        //     $phieuhuy->save();
        // }

        return response(['status' => 'success', 'message' => 'Hủy tour thành công']);
    }
}
