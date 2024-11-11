<?php

namespace App\Http\Controllers\backend;

use App\DataTables\PhuongTienDataTable;
use App\Http\Controllers\Controller;
use App\Models\PhuongTien;
use Illuminate\Http\Request;

class PhuongTienController extends Controller
{
    public function index(PhuongTienDataTable $dataTable)
    {
        return $dataTable->render('backend.phuongtien.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.phuongtien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'tenphuongtien' => 'required',
            'sochongoi' =>'required',
            'giaphuongtien' =>'required',
            'sodienthoai'=>'required',
        ]);

        $khachsan = new PhuongTien();
        $khachsan->tenphuongtien = $request->tenphuongtien;
        $khachsan->sochongoi = $request->sochongoi;
        $khachsan->giaphuongtien = $request->giaphuongtien;
        $khachsan->sodienthoai = $request->sodienthoai;
        $khachsan->save();
        return redirect()->route('phuongtien.index')->with('success', 'Thêm phương tiện thành công!');
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
        $phuongtien = PhuongTien::findOrFail($id);
        return view('backend.phuongtien.edit', compact('phuongtien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $request->validate([
            'tenphuongtien' => 'required',
            'sochongoi' =>'required',
            'giaphuongtien' =>'required',
            'sodienthoai'=>'required',
        ]);
        if(!$validator)
        {
            $this->edit($id) ;
        }
        $khachsan = PhuongTien::findOrFail($id);
        $khachsan->tenphuongtien = $request->tenphuongtien;
        $khachsan->sochongoi = $request->sochongoi;
        $khachsan->giaphuongtien = $request->giaphuongtien;
        $khachsan->sodienthoai = $request->sodienthoai;
        $khachsan->save();
        return redirect()->route('phuongtien.index')->with('success', 'Cập nhật thông tin phương tiện thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PhuongTien::find($id)->delete();
        return response(['status' => 'success', 'message' => 'Xóa thông tin phương tiện thành công']);
    }
}
