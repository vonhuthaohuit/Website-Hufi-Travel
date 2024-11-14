<?php

namespace App\Http\Controllers\backend;

use App\DataTables\NhanVienDataTable;
use App\Http\Controllers\Controller;
use App\Models\NhanVien;
use App\Models\PhongBan;
use Illuminate\Http\Request;

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
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nhanvien = NhanVien::findOrFail($id);
        $phongban = PhongBan::all() ;
        return view('backend.quanlynhanvien.edit', compact('nhanvien','phongban'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nhanvien = NhanVien::findOrFail($id);
        $nhanvien->bangcap = $request->bangcap;
        $nhanvien->maphongban = $request->maphongban;
        $nhanvien->save() ;
        return redirect()->route('nhanvien.index') ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
