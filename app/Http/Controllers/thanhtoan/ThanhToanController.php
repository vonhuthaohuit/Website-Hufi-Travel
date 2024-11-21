<?php

namespace App\Http\Controllers\thanhtoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\thanhtoan\HoaDonController;
use App\Models\HoaDon;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Session;

class ThanhToanController extends Controller
{

    public function thanhToanThanhCong(Request $request)
    {
        $hoaDonController = new HoaDonController();
        $phieuDatTourController = new PhieuDatTourController();
        $user = Session::get('user');
        $maTaiKhoan = $user['mataikhoan'];
        $khachHang = KhachHang::where('mataikhoan', $maTaiKhoan)->first();
        $request->validate([
            'maTour' => 'required',
            'tongTienPhieuDatTour' => 'required|numeric',
            'trangThaiDatTour' => 'required',
            'chiTietPhieuDatTour' => 'required|array',
            'phieuDatTour' => 'required',
            'tongSoTien' => 'required|numeric',
            'phuongThucThanhToan' => 'required',
            'trangThaiThanhToan' => 'required',
            'thongTinNguoiDatTour' => 'required'
        ]);

        $hoaDonController->TaoHoaDon(
            $request->phieuDatTour,
            $request->thongTinNguoiDatTour,
            $request->tongSoTien,
            $request->phuongThucThanhToan,
            $request->trangThaiThanhToan
        );

        return response()->json(['message' => 'Thanh toán thành công và hóa đơn đã được tạo.']);
    }
}
