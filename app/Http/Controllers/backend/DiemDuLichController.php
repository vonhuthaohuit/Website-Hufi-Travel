<?php

namespace App\Http\Controllers\backend;

use App\DataTables\DiemDuLichDataTable;
use App\Http\Controllers\Controller;
use App\Models\DiemDuLich;
use Illuminate\Http\Request;

class DiemDuLichController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DiemDuLichDataTable $dataTable)
    {
        return $dataTable->render('backend.diemdulich.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.diemdulich.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tendiem'=>'required',
            'mota'=>'required',

        ]);

        $diemdulich = new DiemDuLich() ;
        $diemdulich->tendiem = $request->tendiem;
        $diemdulich->mota = $request->mota ;
        $diemdulich->save() ;
        return redirect()->route('diemdulich.index');


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
    public function edit(string $id)
    {
        $diemdulich = DiemDuLich::findOrFail($id);
        return view('backend.diemdulich.edit', compact('diemdulich'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tendiem' => 'required',
        ]);

        $diemdulich = DiemDuLich::findOrFail($id);
        $diemdulich->tendiem = $request->input('tendiem');

        $diemdulich->save();
        return redirect()->route('diemdulich.index')->with('success', 'Cập nhật loại tour thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DiemDuLich::find($id)->delete();
        return response(['status' => 'success', 'message' => 'Xóa thành công']);
    }
}
