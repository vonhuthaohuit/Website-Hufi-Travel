<?php

namespace App\Http\Controllers\backend;

use App\DataTables\NhanVienDataTable;
use App\Http\Controllers\Controller;
use App\Models\NhanVien;
use App\Models\NhomQuyen;
use App\Models\PhongBan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NhanVienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(NhanVienDataTable $dataTable)
    {
        return $dataTable->render('backend.quanlynhanvien.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nhanvien = NhanVien::findOrFail($id);
        $phongban = PhongBan::all();
        $nhomquyen = NhomQuyen::all();
        return view('backend.quanlynhanvien.edit', compact('nhanvien', 'phongban', 'nhomquyen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $check =  $request->has('truongphong') ? true : false;
            $nhanvien = NhanVien::findOrFail($id);
            $nhanvien->bangcap = $request->bangcap;
            $nhanvien->maphongban = $request->maphongban;
            $nhanvien->save();
            $taikhoan = User::findOrFail($nhanvien->mataikhoan);
            $taikhoan->manhomquyen = $request->manhomquyen;
            $taikhoan->save() ;
            if ($check == true) {
                $phongban = PhongBan::find($request->maphongban);
                $phongban->truongphong = $nhanvien->manhanvien;
                $phongban->save();
            }
            return redirect()->route('nhanvien.index')->with('success','Chỉnh sửa nhân viên thành công');
        } catch (Exception $e) {
            Log::error('Error in registration process:', ['error' => $e->getMessage()]);
            return redirect()->route('nhanvien.index')->with('error','Chỉnh sửa nhân viên không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
