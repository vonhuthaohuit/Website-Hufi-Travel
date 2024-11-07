<?php

namespace App\Http\Controllers\backend;

use App\DataTables\KhachSanDataTable;
use App\Http\Controllers\Controller;
use App\Models\KhachSan;
use Exception;
use Illuminate\Http\Request;

class KhachSanController extends Controller
{
    public function index(KhachSanDataTable $dataTable)
    {
        return $dataTable->render('backend.khachsan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.khachsan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'diachi' => 'required',
            'giakhachsan' =>'required',
            'tenkhachsan' =>'required',
            'chatluong' =>'required',
            'sodienthoai'=>'required',
        ]);

        $khachsan = new KhachSan();
        $khachsan->tenkhachsan = $request->tenkhachsan;
        $khachsan->diachi = $request->diachi;
        $khachsan->giakhachsan = $request->giakhachsan;
        $khachsan->chatluong = $request->chatluong;
        $khachsan->sodienthoai = $request->sodienthoai;
        $khachsan->save();
        return redirect()->route('khachsan.index')->with('success', 'Thêm khách sạn thành công!');
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
        $khachsan = KhachSan::findOrFail($id);
        return view('backend.khachsan.edit', compact('khachsan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'diachi' => 'required',
            'giakhachsan' =>'required',
            'tenkhachsan' =>'required',
            'chatluong' =>'required',
            'sodienthoai'=>'required',
        ]);

        $khachsan = KhachSan::findOrFail($id);
        $khachsan->tenkhachsan = $request->tenkhachsan;
        $khachsan->diachi = $request->diachi;
        $khachsan->giakhachsan = $request->giakhachsan;
        $khachsan->chatluong = $request->chatluong;
        $khachsan->sodienthoai = $request->sodienthoai;
        $khachsan->save();
        return redirect()->route('khachsan.index')->with('success', 'Cập nhật thông tin khách sạn thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KhachSan::find($id)->delete();
        return response(['status' => 'success', 'message' => 'Xóa thông tin khách sạn thành công']);
    }
}
