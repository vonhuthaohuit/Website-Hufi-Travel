<?php

namespace App\Http\Controllers\backend;

use App\DataTables\KhuyenMaiDatatables;
use App\Http\Controllers\Controller;
use App\Models\KhuyenMai;
use Illuminate\Http\Request;

class KhuyenMaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(KhuyenMaiDatatables $dataTable)
    {
        return $dataTable->render('backend.khuyenmai.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.khuyenmai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'thoigianbatdau' => 'required',
            'thoigianketthuc' => 'required',
            'phantramgiam' => 'required',
        ]);

        $khuyenmai = new KhuyenMai();
        $khuyenmai->thoigianbatdau = $request->thoigianbatdau;
        $khuyenmai->thoigianketthuc = $request->thoigianketthuc;
        $khuyenmai->phantramgiam = $request->phantramgiam;

        $khuyenmai->save();

        return redirect()->route('khuyenmai.index')->with('success', 'Thêm khuyến mãi thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $khuyenmai = KhuyenMai::findOrFail($id);
        return view('backend.khuyenmai.edit', compact('khuyenmai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'thoigianbatdau' => 'required',
            'thoigianketthuc' => 'required',
            'phantramgiam' => 'required',
        ]);

        $khuyenmai = KhuyenMai::findOrFail($id);
        $khuyenmai->thoigianbatdau = $request->input('thoigianbatdau');
        $khuyenmai->thoigianketthuc = $request->input('thoigianketthuc');
        $khuyenmai->phantramgiam = $request->input('phantramgiam');

        $khuyenmai->save();
        return redirect()->route('khuyenmai.index')->with('success', 'Cập nhật khuyến mãi thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KhuyenMai::find($id)->delete();
        return response(['status' => 'success', 'message' => 'Xóa thành công']);
    }
}
