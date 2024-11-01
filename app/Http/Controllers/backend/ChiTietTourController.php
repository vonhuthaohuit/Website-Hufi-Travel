<?php

namespace App\Http\Controllers\backend;

use App\DataTables\ChiTietTourDataTable;
use App\DataTables\ChuongTrinhTourDataTable;
use App\Http\Controllers\Controller;
use App\Models\ChiTietTour;
use App\Models\DiemDuLich;
use App\Models\Tour;
use Illuminate\Http\Request;

class ChiTietTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChiTietTourDataTable $dataTable,Request $request)
    {

        $tour = Tour::findOrFail($request->tour_id);
        return $dataTable->render('backend.chitiettour.index',compact('tour'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $diemdulich = DiemDuLich::all();
        $tour = Tour::findOrFail($request->tour_id);
        return view('backend.chitiettour.create',compact('tour','diemdulich'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ngaybatdau' => 'required',
            'ngayketthuc' => 'required',
            'gia' => 'required',
            'tour_id' => 'required|exists:tour,id',
            'diemdulich_id' =>'required|exists:diemdulich,id',
        ]);
        $chuongtrinhtour = new ChiTietTour();
        $chuongtrinhtour->ngaybatdau = $request->ngaybatdau;
        $chuongtrinhtour->ngayketthuc = $request->ngayketthuc;
        $chuongtrinhtour->gia = $request->gia;
        $chuongtrinhtour->tour_id = $request->tour_id;
        $chuongtrinhtour->diemdulich_id = $request->diemdulich_id;
        $chuongtrinhtour->save();
        return redirect()->route('chitiettour.index',['tour_id' =>$request->tour_id])->with('success', 'Product updated successfully');;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
