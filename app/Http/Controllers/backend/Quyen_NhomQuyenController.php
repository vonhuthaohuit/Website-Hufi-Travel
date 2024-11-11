<?php

namespace App\Http\Controllers\backend;

use App\DataTables\Quyen_NhomQuyenDataTable;
use App\Http\Controllers\Controller;
use App\Models\NhomQuyen;
use App\Models\Quyen;
use App\Models\Quyen_Nhomquyen;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Quyen_NhomQuyenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Quyen_NhomQuyenDataTable $dataTable, Request $request)
    {
        // if (!$request->has('manhomquyen') || !NhomQuyen::where('manhomquyen', $request->manhomquyen)->exists()) {
        //     return redirect()->back()->with('error', 'Mã nhóm quyền không hợp lệ hoặc không tồn tại.');
        // }

        $nhomquyen = NhomQuyen::findOrFail($request->manhomquyen);
        return $dataTable->render('backend.nhomquyen.quyen_nhomquyen.index', compact('nhomquyen'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $quyen = Quyen::all();
        $nhomquyen = NhomQuyen::findOrFail($request->manhomquyen);
        return view('backend.nhomquyen.quyen_nhomquyen.create', compact('quyen', 'nhomquyen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'maquyen' => 'required|exists:quyen,maquyen',
            'manhomquyen' => 'required|exists:nhomquyen,manhomquyen',
        ]);

        $quyen_nhomquyen = new Quyen_Nhomquyen();
        $quyen_nhomquyen->maquyen = $request->maquyen;
        $quyen_nhomquyen->manhomquyen = $request->manhomquyen;
        $quyen_nhomquyen->created_at = Carbon::parse(now()->format('d-m-Y'));
        $quyen_nhomquyen->updated_at = Carbon::parse(now()->format('d-m-Y'));
        $quyen_nhomquyen->save();
        return redirect()->route('quyen_nhomquyen.index', ['manhomquyen' => $request->manhomquyen])->with('success', 'Thêm quyền vào nhóm thành công');;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    public function destroy(string $id, string $maquyen)
    {
        Quyen_Nhomquyen::where('manhomquyen', $id)
            ->where('maquyen', $maquyen)
            ->delete();
        return response(['status' => 'success', 'message' => 'Xóa quyền khỏi nhóm quyền thành công']);
    }
}
