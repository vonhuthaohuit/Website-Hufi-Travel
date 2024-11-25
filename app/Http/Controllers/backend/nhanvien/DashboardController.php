<?php

namespace App\Http\Controllers\backend\nhanvien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.nhanvien.dashboard.index');
    }
}
