<?php

namespace App\Http\Controllers\thanhtoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThanhToanController extends Controller
{
    public function index() {
        return view('frontend.thanhtoan.thanhtoan');
    }
    
}
