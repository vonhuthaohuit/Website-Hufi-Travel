<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogTour;
use App\Models\LoaiBlog;
use App\Models\Tour;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tours = Tour::with('chitiettour.giachitiettour', 'hinhanhtour:tenhinh,duongdan');
        $blogs = BlogTour::where('trangthaiblog', 1)
                            ->orderBy('mablogtour', 'DESC')->take(3)->get();
        return view("index", compact('tours', 'blogs'));
    }

    public function about() {
        return view('frontend.home.about');
    }

    public function contact() {
        return view('frontend.home.contact');
    }
}
