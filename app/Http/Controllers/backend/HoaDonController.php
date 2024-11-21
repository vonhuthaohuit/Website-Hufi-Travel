<?php

namespace App\Http\Controllers\backend;

use App\DataTables\HoaDonDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HoaDonController extends Controller
{
    public function index(HoaDonDataTable $dataTable)
    {
        return $dataTable->render('view.backend.hoadon.index');
    }
}
