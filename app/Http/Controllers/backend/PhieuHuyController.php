<?php

namespace App\Http\Controllers\backend;

use App\DataTables\PhieuHuyDatatables;
use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use App\Models\PhieuDatTour;
use App\Models\PhieuHuyTour;
use Illuminate\Http\Request;

class PhieuHuyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PhieuHuyDatatables $dataTable)
    {
        return $dataTable->render('backend.hoadon.phieuhuy.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($maphieuhuytour)
    {
        PhieuHuyTour::find($maphieuhuytour)->delete();
        return response(['status' => 'success', 'message' => 'Xóa phiếu hủy thành công']);
    }

    public function edit($maphieuhuytour)
    {
        $phieuhuy = PhieuHuyTour::query()
            ->leftJoin('hoadon', 'phieuhuytour.maphieuhuytour', '=', 'hoadon.maphieuhuytour')
            ->leftJoin('phieudattour', 'hoadon.maphieudattour', '=', 'phieudattour.maphieudattour')
            ->leftJoin('tour', 'phieudattour.matour', '=', 'tour.matour')
            ->select('phieuhuytour.*', 'tour.tentour', 'hoadon.nguoidaidien', 'phieudattour.trangthaidattour', 'phieudattour.maphieudattour')
            ->where('phieuhuytour.maphieuhuytour', $maphieuhuytour)
            ->first();

        return view('backend.hoadon.phieuhuy.edit', compact('phieuhuy'));
    }

    public function update(Request $request, $maphieuhuytour)
    {
        $request->validate([
            'lydohuy' => 'required'
        ]);

        $phieudattour = PhieuDatTour::query()
            ->join('chitietphieudattour', 'phieudattour.maphieudattour', '=', 'chitietphieudattour.maphieudattour')
            ->where('phieudattour.maphieudattour', $request->maphieudattour)
            ->first();

        if (!$phieudattour) {
            return redirect()->back()->with('error', 'Lỗi trong quá trình hủy tour!');
        } else {
            $phieudattour->trangthaidattour = 'Đã hủy';
            $phieudattour->save();
        }


        $phieuhuy = PhieuHuyTour::find($maphieuhuytour);
        $phieuhuy->lydohuy = $request->lydohuy;
        $phieuhuy->ngayhuy = today()->format('Y-m-d');
        $phieuhuy->save();

        HoaDon::where('maphieudattour', $phieudattour->maphieudattour)
            ->update(['maphieuhuytour' => $maphieuhuytour, 'nguoidaidien' => $request->nguoidaidien]);

        $tour = PhieuDatTour::query()
            ->join('tour', 'phieudattour.matour', '=', 'tour.matour')
            ->select('tour.giatour', 'phieudattour.ngaybatdau')
            ->where('phieudattour.maphieudattour', $request->maphieudattour)
            ->first();

        if ($tour) {
            $ngayBatDau = \Carbon\Carbon::parse($tour->ngaybatdau);
            $ngayHuy = \Carbon\Carbon::parse($phieuhuy->ngayhuy);

            $soNgayTruocBatDau = $ngayHuy->diffInDays($ngayBatDau, false);

            $phanTramHoanTien = match (true) {
                $soNgayTruocBatDau > 30 => 1,
                $soNgayTruocBatDau >= 16 => 0.7,
                $soNgayTruocBatDau >= 8 => 0.3,
                $soNgayTruocBatDau >= 4 => 0.1,
                default => 0.0,
            };

            $soTienHoan = $tour->giatour * $phanTramHoanTien;

            $phieuhuy->sotienhoan = $soTienHoan;
            $phieuhuy->save();
        }

        return redirect()->route('phieuhuytour.index')->with('success', 'Xác nhận hủy tour thành công');
    }
}
