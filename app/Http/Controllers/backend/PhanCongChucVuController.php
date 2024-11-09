<?php

namespace App\Http\Controllers\backend;

use App\DataTables\PhanCongChucVuDataTable;
use App\Http\Controllers\Controller;
use App\Models\ChucVu;
use App\Models\NhanVien;
use App\Models\PhanCongChucVu;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class PhanCongChucVuController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(PhanCongChucVuDataTable $dataTable, Request $request)
    {
        if (!$request->has('manhanvien') || !NhanVien::where('manhanvien', $request->manhanvien)->exists()) {
            return redirect()->back()->with('error', 'Mã nhân viên không hợp lệ hoặc không tồn tại.');
        }
        $nhanvien = NhanVien::findOrFail($request->manhanvien);
        return $dataTable->render('backend.chucvu.phancongchucvu.index', compact('nhanvien'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $chucvu = ChucVu::all();
        $nhanvien = NhanVien::findOrFail($request->manhanvien);
        return view('backend.chucvu.phancongchucvu.create', compact('chucvu', 'nhanvien'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
        $request->validate([
            'machucvu' => 'required|exists:chucvu,machucvu',
            'manhanvien' => 'required|exists:nhanvien,manhanvien',
        ]);

        $phancongchucvu = new PhanCongChucVu();
        $phancongchucvu->machucvu = $request->machucvu;
        $phancongchucvu->manhanvien = $request->manhanvien;
        $phancongchucvu->created_at = Carbon::parse(now()->format('d-m-Y'));
        $phancongchucvu->updated_at = Carbon::parse(now()->format('d-m-Y'));
        $phancongchucvu->save();
            return redirect()->route('phancongchucvu.index', ['manhanvien' => $request->manhanvien])->with('success', 'Thêm chức vụ thành công');
        }
        catch (Exception $e)
        {
            return redirect()->route('phancongchucvu.index', ['manhanvien' => $request->manhanvien])->with('error', 'Nhân viên đã có chức vụ này');

        }

    }

    /**
     * Display the specified resource.
     */

    public function destroy(string $id, string $machucvu)
    {
        PhanCongChucVu::where('manhanvien', $id)
            ->where('machucvu', $machucvu)
            ->delete();
        return response(['status' => 'success', 'message' => 'Thu hồi chức vụ thành công']);
    }
}
