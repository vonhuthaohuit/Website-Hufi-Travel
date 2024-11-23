<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\DanhGia;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function createComment(Request $request) {
        $request->validate([
            'noidung' => 'required',
            'diemdanhgia' => 'required',
            'matour' => 'required|exists:tour,matour'
        ]);

        $user = Session::get('user');
        @$maTaiKhoan = $user['mataikhoan'];

        $khachhang = KhachHang::where('mataikhoan', $maTaiKhoan)->first();

        $danhgia = new DanhGia();
        $danhgia->noidung = $request->noidung;
        $danhgia->diemdanhgia = $request->diemdanhgia;
        $danhgia->makhachhang = $khachhang->makhachhang;
        $danhgia->matour = $request->matour;

        $danhgia->save();

        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi thành công');
    }
}
