<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home.index');
    }
    public function nhanvien_home()
    {
        return view('backend.nhanvien.dashboard.index');
    }
}
