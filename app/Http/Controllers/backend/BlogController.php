<?php

namespace App\Http\Controllers\backend;

use App\DataTables\BlogDatatables;
use App\Http\Controllers\Controller;
use App\Models\BlogTour;
use App\Models\LoaiBlog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogDatatables $dataTable)
    {
        return $dataTable->render('backend.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loaiblog = LoaiBlog::all();
        return view('backend.blog.create', compact('loaiblog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tieude' => ['required', 'max:200', 'unique:blogtour,tieude'],
            'noidung' => 'required',
            'loaiblog_id' => 'required',
            'trangthai' => 'required'
        ]);

        $blog = new BlogTour();

        $blog->tieude = $request->tieude;
        $blog->noidung = $request->noidung;
        $blog->trangthai = $request->trangthai;
        $blog->loaiblog_id = $request->loaiblog_id;
        $blog->nhanvien_id = 1;
        // $blog->user_id = Auth::user()->id;

        $blog->save();

        return redirect()->route('blog.index');
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
        $blog = BlogTour::findOrFail($id);
        $loaiblog = LoaiBlog::all();
        return view('backend.blog.edit', compact('blog', 'loaiblog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tieude' => 'required|string|max:255',
            'noidung' => 'required',
            'trangthai' => 'required',
            'loaiblog_id' => 'required',
        ]);

        $blog = BlogTour::findOrFail($id);

        $blog->tieude = $request->input('tieude');
        $blog->noidung = $request->input('noidung');
        $blog->trangthai = $request->input('trangthai');
        $blog->loaiblog_id = $request->input('loaiblog_id');
        $blog->updated_at = now();

        $blog->save();

        return redirect()->route('blog.index')->with('success', 'Cập nhật blog thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BlogTour::find($id)->delete();
        return response(['status' => 'success', 'message' => 'Xóa blog thành công']);
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'trangthai' => 'required',
        ]);

        $tour = BlogTour::findOrFail($request->id);
        $tour->trangthai = $request->trangthai === 'true' ? 1 : 0;
        $tour->save();

        return response()->json(['message' => 'Trạng thái cập nhật thành công!']);
    }
}
