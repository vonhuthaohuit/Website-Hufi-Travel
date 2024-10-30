<?php

namespace App\Http\Controllers\backend;

use App\DataTables\LoaiBlogDatatables;
use App\Http\Controllers\Controller;
use App\Models\LoaiBlog;
use Illuminate\Http\Request;

class LoaiBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LoaiBlogDatatables $dataTable)
    {
        return $dataTable->render('backend.blog.loaiblog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.blog.loaiblog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tenloai' => 'required',
        ]);

        $loaiblog = new LoaiBlog();
        $loaiblog->tenloai = $request->tenloai;

        $loaiblog->save();

        return redirect()->route('loaiblog.index');
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
        $loaiblog = LoaiBlog::findOrFail($id);
        return view('backend.blog.loaiblog.edit', compact('loaiblog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tenloai' => 'required',
        ]);

        $loaiblog = LoaiBlog::findOrFail($id);
        $loaiblog->tenloai = $request->input('tenloai');

        $loaiblog->save();
        return redirect()->route('loaiblog.index')->with('success', 'Cập nhật loại blog thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        LoaiBlog::find($id)->delete();
        return response(['status' => 'success', 'message' => 'Xóa loại blog thành công']);
    }
}
