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
        return view("index");
    }

    public function about() {
        return view('frontend.home.about');
    }

    public function contact() {
        return view('frontend.home.contact');
    }
}
