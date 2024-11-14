<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\DanhGia;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createComment(Request $request) {
        $request->validate([
            'noidung' => 'required',
            'diemdanhgia' => 'required'
        ]);

        $danhgia = new DanhGia();
        $danhgia->noidung = $request->noidung;
        $danhgia->diemdanhgia = $request->diemdanhgia;
        $danhgia->makhachhang = 1;

        $danhgia->save();

        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi thành công');
    }
}
