<?php

namespace App\Http\Controllers\backend;

use App\DataTables\PhanCongNhanVienDataTable;
use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhanCongNhanVienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PhanCongNhanVienDataTable $dataTable, Request $request)
    {
        $tour_id = $request->input('tour_id'); // Lấy tour_id từ request
        $tour = Tour::where('matour', $tour_id)->first();
        if (!$tour_id || !$tour) {
            return redirect()->back()->with('error', 'Tour ID không hợp lệ hoặc không tồn tại.');
        }

        return $dataTable->render('backend.phancong.index', compact('tour'));
    }


    public function danhsachtour()
    {
        $tour = DB::select('CALL proc_selectTourAccept()');
        return view('backend.phancong.danhsachtour', compact('tour'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $tour = Tour::findOrFail($request->tour_id);
        return view('backend.phancong.create',compact('tour'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
