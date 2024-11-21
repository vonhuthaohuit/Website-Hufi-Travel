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
                'sodienthoai' => $khachHang->phone,
                'address' => $khachHang->address,
            ]);
        }

        return response()->json(['message' => 'User not found'], 404);
    }
}
