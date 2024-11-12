<?php

namespace App\Http\Controllers\backend;

use App\DataTables\PhongBanDataTable;
use App\Http\Controllers\Controller;
use App\Models\PhongBan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PhongBanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PhongBanDataTable $dataTable)
    {
        return $dataTable->render('backend.phongban.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.phongban.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tenphongban' => 'required',
        ]);

        $phongban = new PhongBan();
        $phongban->tenphongban = $request->tenphongban;
        $phongban->created_at = Carbon::parse(now()->format('d-m-Y'));
        $phongban->updated_at = Carbon::parse(now()->format('d-m-Y'));

        $phongban->save();
        return redirect()->route('phongban.index');
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
        $phongban = PhongBan::findOrFail($id);
        return view('backend.phongban.edit', compact('phongban'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tenphongban' => 'required',
        ]);

        $chucvu = PhongBan::findOrFail($id);
        $chucvu->tenphongban   = $request->input('tenphongban');
        $chucvu->updated_at = Carbon::parse(now()->format('d-m-Y'));
        $chucvu->save();
        return redirect()->route('phongban.index')->with('success', 'Cập nhật phòng ban thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PhongBan::find($id)->delete();
        return response(['status' => 'success', 'message' => 'Xóa phòng ban thành công']);
    }
}
