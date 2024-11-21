<?php

namespace App\Http\Controllers\thanhtoan;

use App\Http\Controllers\Controller;
use App\Models\ChiTietPhieuDatTour;
use App\Models\PhieuDatTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PhieuDatTourController extends Controller
{
    protected $phieuDatTour;
    public function __construct()
    {
        $this->phieuDatTour = new PhieuDatTour();
    }
    public function index()
    {
        if(Session::get("user") == null){
            return redirect()->route('login');
        }
        $phieuDatTours = $this->phieuDatTour->all();
        return view("frontend.thanhtoan.phieudattour", compact('phieuDatTours'));
    }
    public function TaoPhieuDatTour($maTour, $tongTienPhieuDatTour, $tongSoLuong, $trangThaiDatTour, $ngayDatTour = null)
    {
        $phieuDatTour = PhieuDatTour::create([
            'ngaydattour' => $ngayDatTour ?? date('Y-m-d'),
            'tongtienphieudattour' => $tongTienPhieuDatTour,
            'tongsoluong' => $tongSoLuong,
            'trangthaidattour' => $trangThaiDatTour,
            'matour' => $maTour,
        ]);

        return $phieuDatTour->toArray();
    }

    public function XoaPhieuDatTour($id)
    {
        $phieuDatTour = PhieuDatTour::find($id);

        if ($phieuDatTour) {
            $phieuDatTour->delete();
            return response()->json(['message' => 'Phiếu đặt tour đã được xoá thành công.']);
        } else {
            return response()->json(['message' => 'Không tìm thấy phiếu đặt tour.'], 404);
        }
    }
    public function SuaPhieuDatTour(Request $request, $id)
    {
        $phieuDatTour = PhieuDatTour::find($id);

        if ($phieuDatTour) {
            $phieuDatTour->update([
                'ngaydattour' => $request->ngayDatTour ?? $phieuDatTour->ngaydattour,
                'tongtienphieudattour' => $request->tongTienPhieuDatTour ?? $phieuDatTour->tongtienphieudattour,
                'trangthaidattour' => $request->trangThaiDatTour ?? $phieuDatTour->trangthaidattour,
                'matour' => $request->maTour ?? $phieuDatTour->matour,
            ]);
            return response()->json(['message' => 'Cập nhật phiếu đặt tour thành công.']);
        } else {
            return response()->json(['message' => 'Không tìm thấy phiếu đặt tour.'], 404);
        }
    }

    public function TaoChiTietPhieuDatTour($makhachhang, $maphieudattour, $dongiadattour)
    {
        $chiTietPhieuDatTour = ChiTietPhieuDatTour::create([
            'makhachhang' => $makhachhang,
            'maphieudattour' => $maphieudattour,
            'chitietsotiendat' => $dongiadattour,
        ]);
        return $chiTietPhieuDatTour;
    }
    public function XoaChiTietPhieuDatTour($id)
    {
        $chiTietPhieuDatTour = ChiTietPhieuDatTour::find($id);

        if ($chiTietPhieuDatTour) {
            $chiTietPhieuDatTour->delete();
            return response()->json(['message' => 'Chi tiết phiếu đặt tour đã được xoá thành công.']);
        } else {
            return response()->json(['message' => 'Không tìm thấy chi tiết phiếu đặt tour.'], 404);
        }
    }
    public function SuaChiTietPhieuDatTour(Request $request, $id)
    {
        $chiTietPhieuDatTour = ChiTietPhieuDatTour::find($id);

        if ($chiTietPhieuDatTour) {
            $chiTietPhieuDatTour->update([
                'makhachhang' => $request->makhachhang ?? $chiTietPhieuDatTour->makhachhang,
                'maphieudattour' => $request->maphieudattour ?? $chiTietPhieuDatTour->maphieudattour,
                'chitietsotiendat' => $request->dongiadattour ?? $chiTietPhieuDatTour->chitietsotiendat,
            ]);
            return response()->json(['message' => 'Cập nhật chi tiết phiếu đặt tour thành công.']);
        } else {
            return response()->json(['message' => 'Không tìm thấy chi tiết phiếu đặt tour.'], 404);
        }
    }
}
