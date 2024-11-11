<?php

namespace App\Http\Controllers\backend;

use App\DataTables\ChucVuDataTable;
use App\Http\Controllers\Controller;
use App\Models\ChucVu;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChucVuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChucVuDataTable $dataTable)
    {
        return $dataTable->render('backend.chucvu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.chucvu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tenchucvu' => 'required',
        ]);

        $chucvu = new ChucVu();
        $chucvu->tenchucvu = $request->tenchucvu;
        $chucvu->created_at = Carbon::parse(now()->format('d-m-Y'));
        $chucvu->updated_at = Carbon::parse(now()->format('d-m-Y'));

        $chucvu->save();
        return redirect()->route('chucvu.index');
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
        $chucvu = ChucVu::findOrFail($id);
        return view('backend.chucvu.edit', compact('chucvu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tenchucvu' => 'required',
        ]);

        $chucvu = ChucVu::findOrFail($id);
        $chucvu->tenchucvu   = $request->input('tenchucvu');
        $chucvu->updated_at = Carbon::parse(now()->format('d-m-Y'));
        $chucvu->save();
        return redirect()->route('chucvu.index')->with('success', 'Cập nhật chức vụ thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ChucVu::find($id)->delete();
        return response(['status' => 'success', 'message' => 'Xóa chức vụ thành công']);
    }
}
