<?php

namespace App\Http\Controllers\backend;

use App\DataTables\LoaiTourDatatables;
use App\Http\Controllers\Controller;
use App\Models\LoaiTour;
use Illuminate\Http\Request;

class LoaiTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LoaiTourDatatables $dataTable)
    {
        return $dataTable->render('backend.tour.loaitour.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.tour.loaitour.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tenloai' => 'required',
        ]);

        $loaitour = new LoaiTour();
        $loaitour->tenloai = $request->tenloai;
        $loaitour->save();

        return redirect()->route('loaitour.index');
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

        $loaitour = LoaiTour::findOrFail($id);
        return view('backend.tour.loaitour.edit', compact('loaitour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tenloai' => 'required',
        ]);

        $loaitour = LoaiTour::findOrFail($id);
        $loaitour->tenloai = $request->input('tenloai');

        $loaitour->save();
        return redirect()->route('loaitour.index')->with('success', 'Cập nhật loại tour thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        LoaiTour::find($id)->delete();
        return response(['status' => 'success', 'message' => 'Xóa thành công']);
    }
}
