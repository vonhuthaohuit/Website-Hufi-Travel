<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BlogTour;
use App\Models\KhachHang;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalUsers = KhachHang::count() ;
        $totalBlogs = BlogTour::count() ;
        $totalTour = Tour::count() ;
        return view('backend.dashboard.index',compact('totalUsers','totalBlogs','totalTour'));
    }

}
