<?php

namespace App\Http\Controllers\backend;

use App\DataTables\KhachSan_TourDataTable;
use App\Http\Controllers\Controller;
use App\Models\KhachSan;
use App\Models\KhachSan_Tour;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KhachSan_TourController extends Controller
{
    public function index(KhachSan_TourDataTable $dataTable, Request $request)
    {
        if (!$request->has('tour_id') || !Tour::where('matour', $request->tour_id)->exists()) {
            return redirect()->back()->with('error', 'Tour ID không hợp lệ hoặc không tồn tại.');
        }
        $tour = Tour::findOrFail($request->tour_id);
        return $dataTable->render('backend.tour.khachsan_tour.index', compact('tour'));
    }

    public function create(Request $request)
    {
        $tour = Tour::findOrFail($request->tour_id);
        $khachsan = KhachSan::all();
        return view('backend.tour.khachsan_tour.create', compact('tour', 'khachsan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'makhachsan' => 'required|exists:khachsan,makhachsan',
            'vitriphong' => 'required',
            'succhua' => 'required',
            'tour_id' => 'required|exists:tour,matour',
        ]);
        $khachsan_tour = new KhachSan_Tour();
        $khachsan_tour->makhachsan = $request->makhachsan;
        $khachsan_tour->vitriphong = $request->vitriphong;
        $khachsan_tour->succhua = $request->succhua;
        $khachsan_tour->matour = $request->tour_id;
        $khachsan_tour->save();
        $giatour =  DB::select('SELECT func_giatour(?) AS giatour', [$request->tour_id]);
        $giatour = $giatour[0]->giatour ?? 0;
        $tour = Tour::where('matour', $request->tour_id)->first();
        $tour->giatour = $giatour;
        $tour->save();
        return redirect()->route('khachsan_tour.index', ['tour_id' => $request->tour_id])->with('success', 'Thêm thông tin phương tiện vào tour thành công');;
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id, String $makhachsan)
    {
        $khachsan_tour = KhachSan_Tour::where('matour', $id)
            ->where('makhachsan', $makhachsan)
            ->first();
        $khachsan = KhachSan_Tour::all();
        return view('backend.tour.khachsan_tour.edit', compact('khachsan_tour', 'khachsan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'vitriphong' => 'required',
            'succhua' => 'required',
        ]);
        $khachsan_tour = KhachSan_Tour::where('makhachsan', $request->makhachsan_id)
            ->where('matour', $id)
            ->update([
                'vitriphong' => $request->input('vitriphong'),
                'succhua' => $request->input('succhua')
            ]);
        $giatour =  DB::select('SELECT func_giatour(?) AS giatour', [$id]);
        $giatour = $giatour[0]->giatour ?? 0;
        $tour = Tour::where('matour', $id)->first();
        $tour->giatour = $giatour;
        $tour->save();
        return redirect()->route('khachsan_tour.index', ['tour_id' => $request->tour_id])->with('success', 'Cập nhật tour thành công!');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(string $id, string $makhachsan)
    {

        KhachSan_Tour::where('matour', $id)
            ->where('makhachsan', $makhachsan)
            ->delete();
        $giatour =  DB::select('SELECT func_giatour(?) AS giatour', [$id]);
        $giatour = $giatour[0]->giatour ?? 0;
        $tour = Tour::where('matour', $id)->first();
        $tour->giatour = $giatour;
        $tour->save();
        return response(['status' => 'success', 'message' => 'Xóa thành công']);
    }
}
