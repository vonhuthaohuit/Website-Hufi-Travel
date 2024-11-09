<?php

namespace App\Http\Controllers\backend;

use App\DataTables\NhomQuyenDataTable;
use App\Http\Controllers\Controller;
use App\Models\NhomQuyen;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NhomQuyenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(NhomQuyenDataTable $dataTable)
    {
        return $dataTable->render('backend.nhomquyen.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.nhomquyen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'tennhomquyen' => 'required',
        ]);

        $nhomquyen = new NhomQuyen();
        $nhomquyen->tennhomquyen = $request->tennhomquyen;
        $nhomquyen->created_at = Carbon::parse(now()->format('d-m-Y'));
        $nhomquyen->updated_at = Carbon::parse(now()->format('d-m-Y'));
        $nhomquyen->save();
        return redirect()->route('nhomquyen.index')->with('success', 'Thêm nhóm quyền thành công!');
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
        $nhomquyen = NhomQuyen::findOrFail($id);
        return view('backend.nhomquyen.edit', compact('nhomquyen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator =$request->validate([
            'tennhomquyen' => 'required',
        ]);
        if(!$validator)
        {
            $this->edit($id) ;
        }
        $nhomquyen = NhomQuyen::findOrFail($id);
        $nhomquyen->tennhomquyen = $request->tennhomquyen;
        $nhomquyen->updated_at = Carbon::parse(now()->format('d-m-Y'));
        $nhomquyen->save();
        return redirect()->route('nhomquyen.index')->with('success', 'Cập nhật thông tin nhóm quyền thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        NhomQuyen::find($id)->delete();
        return response(['status' => 'success', 'message' => 'Xóa thông tin nhóm quyền thành công']);
    }
}
