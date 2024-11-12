<?php

namespace App\Http\Controllers\thanhtoan;

use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HoaDonController extends Controller
{
    protected $hoaDon;
    public function __construct()
    {
        $this->hoaDon = new HoaDon();
    }
    public function index(){
        if(Session::get("user") == null){
            return redirect()->route('login');
        }
        $hoaDons = $this->hoaDon->all();
        return view("frontend.thanhtoan.hoadon", compact('hoaDons'));
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
}
