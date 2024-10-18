<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\LoaiBlog;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $loaiBlogs = LoaiBlog::all();
dd($loaiBlogs);
        return view('index');
    }
}
