<?php

namespace App\Http\Controllers\backend;

use App\DataTables\DanhGiaDataTables;
use App\Http\Controllers\Controller;
use App\Models\DanhGia;
use Illuminate\Http\Request;

class DanhGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DanhGiaDataTables $dataTable)
    {
        return $dataTable->render('backend.danhgia.index');
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'madanhgia' => 'required',
            'tinhtrang' => 'required',
        ]);

        $tour = DanhGia::findOrFail($request->madanhgia);
        $tour->tinhtrang = $request->tinhtrang === 'true' ? 1 : 0;
        $tour->save();

        return response()->json(['message' => 'Tình trạng cập nhật thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($madanhgia)
    {
        DanhGia::find($madanhgia)->delete();
        return response(['status' => 'success', 'message' => 'Xóa đánh giá thành công']);
    }
}
