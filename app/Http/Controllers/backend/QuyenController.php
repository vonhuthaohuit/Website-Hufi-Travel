<?php

namespace App\Http\Controllers\backend;

use App\DataTables\QuyenDataTable;
use App\Http\Controllers\Controller;
use App\Models\Quyen;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuyenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(QuyenDataTable $dataTable)
    {
        return $dataTable->render('backend.quyen.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.quyen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'tenquyen' => 'required',
            'mota' =>'required',
        ]);

        $quyen = new Quyen();
        $quyen->tenquyen = $request->tenquyen;
        $quyen->mota = $request->mota;
        $quyen->created_at = Carbon::parse(now()->format('d-m-Y'));
        $quyen->updated_at = Carbon::parse(now()->format('d-m-Y'));
        $quyen->save();
        return redirect()->route('quyen.index')->with('success', 'Thêm quyền thành công!');
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
        $quyen = Quyen::findOrFail($id);
        return view('backend.quyen.edit', compact('quyen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator =$request->validate([
            'tenquyen' => 'required',
            'mota' =>'required',
        ]);
        if(!$validator)
        {
            $this->edit($id) ;
        }
        $quyen = Quyen::findOrFail($id);
        $quyen->tenquyen = $request->tenquyen;
        $quyen->mota = $request->mota;
        $quyen->updated_at = Carbon::parse(now()->format('d-m-Y'));
        $quyen->save();
        return redirect()->route('quyen.index')->with('success', 'Cập nhật thông tin quyền thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Quyen::find($id)->delete();
        return response(['status' => 'success', 'message' => 'Xóa thông tin quyền thành công']);
    }
}
