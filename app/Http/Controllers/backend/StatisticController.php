<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{

    public function viewStatisticKhachHang()
    {
        return view('backend.statistic.index') ;
    }


    public function statisticKhachHang()
    {
        $data = DB::select('CALL proc_statisticKhachHang()') ;
        return response()->json($data);
    }
}
