<?php

namespace App\Http\Controllers\backend;

use App\DataTables\PhuongTien_TourDataTable;
use App\Http\Controllers\Controller;
use App\Models\PhuongTien;
use App\Models\PhuongTien_Tour;
use App\Models\Tour;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhuongTien_TourController extends Controller
{
    public function index(PhuongTien_TourDataTable $dataTable, Request $request)
    {
        if (!$request->has('tour_id') || !Tour::where('matour', $request->tour_id)->exists()) {
            return redirect()->back()->with('error', 'Tour ID không hợp lệ hoặc không tồn tại.');
        }
        $tour = Tour::findOrFail($request->tour_id);
        return $dataTable->render('backend.tour.phuongtien_tour.index', compact('tour'));
    }

    public function create(Request $request)
    {
        $tour = Tour::findOrFail($request->tour_id);
        $phuongtien = PhuongTien::all();
        return view('backend.tour.phuongtien_tour.create', compact('tour', 'phuongtien'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'maphuongtien' => 'required|exists:phuongtien,maphuongtien',
                'soluonghanhkhach' => 'required',
                'tour_id' => 'required|exists:tour,matour',
            ]);
            if ($request->ghichu == null) {
                $ghichu = 'Không có';
            } else
                $ghichu = $request->ghichu;
            $phuongtien_tour = new PhuongTien_Tour();
            $phuongtien_tour->maphuongtien = $request->maphuongtien;
            $phuongtien_tour->soluonghanhkhach = $request->soluonghanhkhach;
            $phuongtien_tour->ghichu = $ghichu;
            $phuongtien_tour->matour = $request->tour_id;
            $phuongtien_tour->save();
            $giatour =  DB::select('SELECT func_giatour(?) AS giatour', [$request->tour_id]);
            $giatour = $giatour[0]->giatour ?? 0;
            $tour = Tour::where('matour', $request->tour_id)->first();
            $tour->giatour = $giatour;
            $tour->save();
            return redirect()->route('phuongtien_tour.index', ['tour_id' => $request->tour_id])->with('success', 'Thêm thông tin khách sạn vào tour thành công');
        } catch (Exception $e) {
            return redirect()->route('phuongtien_tour.index', ['tour_id' => $request->tour_id])->with('error', 'Thêm thông tin khách sạn vào tour không thành công');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    public function edit(String $id, String $maphuongtien)
    {
        $phuongtien_tour = PhuongTien_Tour::where('matour', $id)
            ->where('maphuongtien', $maphuongtien)
            ->first();
        $phuongtien = PhuongTien_Tour::all();
        return view('backend.tour.phuongtien_tour.edit', compact('phuongtien_tour', 'phuongtien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'soluonghanhkhach' => 'required',
            'ghichu' => 'required',
        ]);
        $khachsan_tour = PhuongTien_Tour::where('maphuongtien', $request->maphuongtien_id)
            ->where('matour', $id)
            ->update([
                'soluonghanhkhach' => $request->input('soluonghanhkhach'),
                'ghichu' => $request->input('ghichu')
            ]);
        $giatour =  DB::select('SELECT func_giatour(?) AS giatour', [$id]);
        $giatour = $giatour[0]->giatour ?? 0;
        $tour = Tour::where('matour', $id)->first();
        $tour->giatour = $giatour;
        $tour->save();

        return redirect()->route('phuongtien_tour.index', ['tour_id' => $request->tour_id])->with('success', 'Cập nhật phương tiện tour thành công!');
    }
    public function destroy(string $id, string $maphuongtien)
    {

        $a = PhuongTien_Tour::where('maphuongtien', $maphuongtien)
            ->where('matour', $id)->delete();
        $giatour =  DB::select('SELECT func_giatour(?) AS giatour', [$id]);
        $giatour = $giatour[0]->giatour ?? 0;
        $tour = Tour::where('matour', $id)->first();
        $tour->giatour = $giatour;
        $tour->save();
        return response(['status' => 'success', 'message' => 'Xóa thành công']);
    }
}
