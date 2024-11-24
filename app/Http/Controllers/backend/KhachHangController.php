<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\KhachHang;
use App\Models\User;
use Illuminate\Http\Request;

class KhachHangController extends Controller
{
    public function getKhachHangDetails($userId)
    {
        $user = User::find($userId);
        $khachHang = KhachHang::where('mataikhoan', $userId)->first();
        if ($khachHang) {
            return response()->json([
                'hoten' => $khachHang->hoten,
                'email' => $user->email,
                'sodienthoai' => $khachHang->sodienthoai,
                'address' => $khachHang->diachi,
            ]);
        }

        return response()->json(['message' => 'User not found'], 404);
    }
    public function validateCCCD(Request $request)
    {
        $cccd = $request->input('ticket_cccd');

        if (empty($cccd)) {
            return response()->json([
                'error' => 'Vui lòng nhập số CMND/CCCD.'
            ], 400);
        }
        $user = session()->get('user');
        $khachHang = KhachHang::where('mataikhoan', $user['mataikhoan'])->first();
        $exists = KhachHang::where('cccd', $cccd)->exists();

        if ($exists) {
            return response()->json([
                'error' => 'Số CMND/CCCD này đã tồn tại trong cơ sở dữ liệu.'
            ], 400);
        }

        return response()->json([
            'success' => 'CMND/CCCD hợp lệ.',
            'cccd' => $cccd
        ], 200);
    }
}
