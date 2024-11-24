<?php

namespace App\Http\Controllers\thanhtoan;

use App\Http\Controllers\Controller;
use App\Models\PhieuHuyTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PhieuHuyTourController extends Controller
{
    protected $phieuHuyTour;
    public function __construct()
    {
        $this->phieuHuyTour = new PhieuHuyTour();
    }
    public function index()
    {
        if(Session::get("user") == null){
            return redirect()->route('login');
        }
        $phieuHuyTours = $this->phieuHuyTour->all();
        return view("frontend.thanhtoan.phieuhuytour", compact('phieuHuyTours'));
    }
}
