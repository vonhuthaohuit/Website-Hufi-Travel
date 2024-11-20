<?php

namespace App\Http\Controllers\backend;

use App\DataTables\ChiTietTourDataTable;
use App\DataTables\ChuongTrinhTourDataTable;
use App\Http\Controllers\Controller;
use App\Models\ChiTietTour;
use App\Models\DiemDuLich;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChiTietTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChiTietTourDataTable $dataTable,Request $request)
    {
        if (!$request->has('tour_id') || !Tour::where('matour', $request->tour_id)->exists())
        {
            return redirect()->back()->with('error', 'Tour ID không hợp lệ hoặc không tồn tại.');
        }
        $tour = Tour::findOrFail($request->tour_id);
        return $dataTable->render('backend.tour.chitiettour.index',compact('tour'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $diemdulich = DiemDuLich::all();
        $tour = Tour::findOrFail($request->tour_id);
        return view('backend.tour.chitiettour.create',compact('tour','diemdulich'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ngaybatdau' => 'required',
            'gia' => 'required',
            'tour_id' => 'required|exists:tour,matour',
            'madiemdulich' =>'required|exists:diemdulich,madiemdulich',
        ]);

        $chuongtrinhtour = new ChiTietTour();
        $chuongtrinhtour->ngaybatdau = $request->ngaybatdau;
        $chuongtrinhtour->matour = $request->tour_id;
        $chuongtrinhtour->madiemdulich = $request->madiemdulich;
        $ngayketthuc = $this->createNgayKetThuc($chuongtrinhtour->matour,$chuongtrinhtour->madiemdulich,$chuongtrinhtour->ngaybatdau);
        $chuongtrinhtour->ngayketthuc = $ngayketthuc;
        $chuongtrinhtour->giachitiettour = $request->gia;
        $chuongtrinhtour->save();
        return redirect()->route('chitiettour.index',['tour_id' =>$request->tour_id])->with('success', 'Product updated successfully');;
    }

    public function createNgayKetThuc($id,$diemdulichID,$ngaybatdau)
    {
        $ngayketthuc = DB::select("SELECT func_create_NgayKetThuc(?,?,?) AS ngayketthuc", [
            $id,          // Tham số mã tour (id)
            $diemdulichID,
            $ngaybatdau  // Tham số ngày bắt đầu
        ]);
        return $ngayketthuc[0]->ngayketthuc;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *///,$madiemdulich
    public function edit( $id,$madiemdulich)
    {
        $chitiettour = ChiTietTour::where('matour',$id)
                                    ->where('madiemdulich',$madiemdulich)
                                    ->first() ;
        return view('backend.tour.chitiettour.edit',compact('chitiettour')) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ngaybatdau' => 'required',
            'gia' => 'required',
            'tour_id' => 'required|exists:tour,matour',
            'madiemdulich' =>'required',
        ]);
        $chitiettour = ChiTietTour::where('matour',$id)
                                    ->where('madiemdulich',$request->madiemdulich)
                                    ->update([
                                        'ngaybatdau' =>$request->ngaybatdau,
                                        'ngayketthuc'=>$this->createNgayKetThuc($request->tour_id,$request->madiemdulich,$request->ngaybatdau),
                                        'giachitiettour'=>$request->gia
                                    ]);
        return redirect()->route('chitiettour.index',['tour_id' =>$request->tour_id])->with('success', 'Product updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,string $madiemdulich)
    {
       ChiTietTour::where('matour',$id)
        ->where('madiemdulich',$madiemdulich)
        ->delete() ;
        return response(['status' => 'success', 'message' => 'Xóa thành công']);

    }
}
