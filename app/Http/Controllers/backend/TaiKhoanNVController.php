<?php

namespace App\Http\Controllers\backend;

use App\DataTables\TaiKhoanNVDatatables;
use App\Http\Controllers\Controller;
use App\Models\NhanVien;
use App\Models\NhomQuyen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Testing\Fakes\Fake;

class TaiKhoanNVController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaiKhoanNVDatatables $dataTable)
    {
        return $dataTable->render('backend.taikhoan.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.taikhoan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'matkhau' => 'required|min:6',
            'tentaikhoan' => 'required'
        ]);

        $taikhoan = new User();
        $taikhoan->email = $request->email;
        $taikhoan->matkhau = $request->matkhau;
        $taikhoan->tentaikhoan = $request->tentaikhoan;
        $taikhoan->manhomquyen = 1;
        $taikhoan->trangthai = $request->trangthai;
        $taikhoan->save();

        $nhanvien = new NhanVien();
        $nhanvien->mataikhoan = $taikhoan->mataikhoan;
        $nhanvien->maphongban = 5;
        $nhanvien->save();

        return redirect()->route('taikhoannv.index')->with('success', 'Thêm tài khoản thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($mataikhoan)
    {
        $taikhoan = User::findOrFail($mataikhoan);
        return view('backend.taikhoan.edit', compact('taikhoan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $mataikhoan)
    {
        $request->validate([
            'email' => 'required',
            'tentaikhoan' => 'required'
        ]);

        $taikhoan = User::findOrFail($mataikhoan);
        $taikhoan->email = $request->input('email');
        $taikhoan->tentaikhoan = $request->input('tentaikhoan');
        $taikhoan->trangthai = $request->input('trangthai');
        $taikhoan->save();

        return redirect()->route('taikhoannv.index')->with('success', 'Cập nhật tài khoản thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mataikhoan)
    {
        User::find($mataikhoan)->delete();
        return response(['status' => 'success', 'message' => 'Xóa tài khoản thành công']);
    }

    public function changeStatus(Request $request)
    {
        $taikhoan = User::findOrFail($request->mataikhoan);
        $taikhoan->trangthai = $request->trangthai === 'true' ? 'Hoạt động' : 'Khóa';
        $taikhoan->save();
        return response()->json(['message' => 'Trạng thái cập nhật thành công!']);
    }
}
