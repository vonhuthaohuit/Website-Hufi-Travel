<?php

namespace App\Http\Controllers\backend;

use App\DataTables\ChuongTrinhTourDataTable;
use App\Http\Controllers\Controller;
use App\Models\ChucVu;
use App\Models\ChuongTrinhTour;
use App\Models\Tour;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChuongTrinhTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChuongTrinhTourDataTable $dataTable,Request $request)
    {
        if (!$request->has('tour_id') || !Tour::where('matour', $request->tour_id)->exists()) {
            return redirect()->back()->with('error', 'Tour ID không hợp lệ hoặc không tồn tại.');
        }
        $tour = Tour::findOrFail($request->tour_id);
        return $dataTable->render('backend.tour.chuongtrinhtour.index',compact('tour'));
    }



    public function create(Request $request)
    {
        $tour = Tour::findOrFail($request->tour_id);
        return view('backend.tour.chuongtrinhtour.create',compact('tour'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'tieude' => 'required',
            'ngay' => 'required',
            'mota' => 'required',
            'tour_id' => 'required|exists:tour,matour',
        ]);
        $chuongtrinhtour = new ChuongTrinhTour();
        $chuongtrinhtour->tieude = $request->tieude;
        $chuongtrinhtour->ngay = $request->ngay;
        $chuongtrinhtour->mota = $request->mota;
        $chuongtrinhtour->matour = $request->tour_id;
        $chuongtrinhtour->save();
        DB::statement('CALL proc_updateTourStatus(?)', [$chuongtrinhtour->matour]);
        return redirect()->route('chuongtrinhtour.index',['tour_id' =>$request->tour_id])->with('success', 'Tạo chương trình tour thành công');;
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $chuongtrinhtour = ChuongTrinhTour::findOrFail($id);
        return view('backend.tour.chuongtrinhtour.edit', compact('chuongtrinhtour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tieude' => 'required|string|max:255',
            'mota' => 'required|string',
            'ngay' =>'required|string',
            'tour_id' =>'required'
        ]);

        $chuongtrinhtour = ChuongTrinhTour::findOrFail($id);
        $chuongtrinhtour->tieude = $request->input('tieude');
        $chuongtrinhtour->mota = $request->input('mota');
        $chuongtrinhtour->ngay = $request->input('ngay');
        $chuongtrinhtour->save();
        return redirect()->route('chuongtrinhtour.index',['tour_id' =>$request->tour_id])->with('success', 'Cập nhật tour thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
        {
            try
            {
                $tour = ChuongTrinhTour::find($id);
                $tour->delete();
                DB::statement('CALL proc_updateTourStatus(?)', [$tour->matour]);
                return response(['status' => 'success', 'message' => 'Xóa thành công']);
            }
            catch(Exception $e)
            {
            Log::error('Error in registration process:', ['error' => $e->getMessage()]);
                return response(['status' => 'error', 'message' => 'Xóa không thành công']);
            }

        }

}
