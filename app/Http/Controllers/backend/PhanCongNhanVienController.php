<?php

namespace App\Http\Controllers\backend;

use App\DataTables\PhanCongNhanVienDataTable;
use App\Http\Controllers\Controller;
use App\Models\NhanVien;
use App\Models\PhanCongNhanVien;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhanCongNhanVienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PhanCongNhanVienDataTable $dataTable, Request $request)
    {
        $tour_id = $request->input('tour_id'); // Lấy tour_id từ request
        $tour = Tour::where('matour', $tour_id)->first();
        if (!$tour_id || !$tour) {
            return redirect()->back()->with('error', 'Tour ID không hợp lệ hoặc không tồn tại.');
        }

        return $dataTable->render('backend.phancong.index', compact('tour'));
    }


    public function danhsachtour()
    {
        $tour = DB::select('CALL proc_selectTourAccept()');

        return view('backend.phancong.danhsachtour', compact('tour'));
    }

    public function layDSNhanVienTheoTour($matour)
    {
        if (is_null($matour)) {
            return response()->json(['error' => 'Tour ID is required'], 400);
        }

        // Gọi stored procedure để lấy danh sách nhân viên theo tour_id
        $nhanvien = DB::select('CALL proc_selectNhanVienTheoTour(?)', [$matour]);
        return response()->json($nhanvien);
    }


    public function chonNhanVienTheoChucVu(String $tenchucvu)
    {
        $data = DB::select('CALL proc_selectNhanVienTheoChucVu(?)', [$tenchucvu]);
        return response()->json($data);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $tour = Tour::findOrFail($request->tour_id);
        return view('backend.phancong.create', compact('tour'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kiểm tra nếu dữ liệu hợp lệ
        $validated = $request->validate([
            'tour_id' => 'required|exists:tour,matour',
            'nhiemvu' => 'required|string',
            'nhanvien' => 'required|array',
            'nhanvien.*' => 'exists:nhanvien,manhanvien',
        ]);

        // Lưu các nhân viên được phân công vào tour
        foreach ($validated['nhanvien'] as $manhanvien) {
            PhanCongNhanVien::create([
                'matour' => $validated['tour_id'],
                'manhanvien' => $manhanvien,
                'nhiemvu' => $validated['nhiemvu'],
            ]);
            DB::statement('CALL proc_updateTinhTrangNhanVien(?,?)', [$manhanvien, 1]);
        }
        // Chuyển hướng về trang trước đó
        return redirect()->route('phancongnhanvien.index', ['tour_id' => $validated['tour_id']])
            ->with('success', 'Phân công nhân viên thành công!');
    }

    /**
     * Display the specified resource.
     */


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
    public function destroy($id, $manhanvien)
    {
        PhanCongNhanVien::where('matour', $id)
            ->where('manhanvien', $manhanvien)
            ->delete();
        DB::statement('CALL proc_updateTinhTrangNhanVien(?,?)', [$manhanvien, 0]);
        return response(['status' => 'success', 'message' => 'Xóa quyền khỏi nhóm quyền thành công']);
    }
}
