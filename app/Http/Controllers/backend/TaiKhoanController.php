<?php

namespace App\Http\Controllers\backend;

use App\DataTables\TaiKhoanDatatables;
use App\Http\Controllers\Controller;
use App\Models\KhachHang;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaiKhoanDatatables $dataTable)
    {
        return $dataTable->render('backend.taikhoan.taikhoankhachhang.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.taikhoan.taikhoankhachhang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'matkhau' => 'required',
            'tentaikhoan' => 'required'
        ]);

        $taikhoan = new User();
        $taikhoan->email = $request->email;
        $taikhoan->matkhau = $request->matkhau;
        $taikhoan->tentaikhoan = $request->tentaikhoan;
        $taikhoan->manhomquyen = 2;
        $taikhoan->trangthai = $request->trangthai;
        $taikhoan->save();

        $khachhang = new KhachHang();
        $khachhang->mataikhoan = $taikhoan->mataikhoan;
        $khachhang->hoten = "Chưa có";
        $khachhang->maloaikhachhang = 1;
        $khachhang->save();

        return redirect()->route('taikhoan.index')->with('success', 'Thêm tài khoản thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($mataikhoan)
    {
        $taikhoan = User::findOrFail($mataikhoan);
        return view('backend.taikhoan.taikhoankhachhang.edit', compact('taikhoan'));
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

        return redirect()->route('taikhoan.index')->with('success', 'Cập nhật tài khoản thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mataikhoan)
    {
        try
        {
            User::find($mataikhoan)->delete();
            return response(['status' => 'success', 'message' => 'Xóa tài khoản thành công']);
        }
        catch(Exception $e)
        {
            return response(['status' => 'error', 'message' => 'Xóa tài khoản không thành công']);
        }

    }

    public function changeStatus(Request $request)
    {
        $taikhoan = User::findOrFail($request->mataikhoan);
        $taikhoan->trangthai = $request->trangthai === 'true' ? 'Hoạt động' : 'Khóa';
        $taikhoan->save();
        return response()->json(['message' => 'Trạng thái cập nhật thành công!']);
    }
}
