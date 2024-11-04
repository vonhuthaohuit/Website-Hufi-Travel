<?php

namespace App\Http\Controllers\backend;

use App\DataTables\BlogDatatables;
use App\Http\Controllers\Controller;
use App\Models\BlogTour;
use App\Models\LoaiBlog;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    use ImageUploadTrait;
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
            'maloaiblog' => 'required',
            'trangthaiblog' => 'required',
            'hinhanh' => 'required'
        ]);

        $imagePath = $this->uploadImage($request, 'hinhanh', 'frontend/images/blog');
        if (!$imagePath) {
            return back()->withErrors(['hinhanh' => 'Hình ảnh không được tải lên.']);
        }

        $blog = new BlogTour();

        $blog->tieude = $request->tieude;
        $blog->noidung = $request->noidung;
        $blog->trangthaiblog = $request->trangthaiblog;
        $blog->maloaiblog = $request->maloaiblog;
        $blog->slug = Str::slug($request->tieude);
        $blog->hinhanh = $imagePath;
        $blog->manhanvien = 1;
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
    public function edit($mablogtour)
    {
        $blog = BlogTour::findOrFail($mablogtour);
        $loaiblog = LoaiBlog::all();
        return view('backend.blog.edit', compact('blog', 'loaiblog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $mablogtour)
    {
        // dd($request->all());
        $request->validate([
            'tieude' => 'required|string|max:255',
            'noidung' => 'required',
            'trangthaiblog' => 'required',
            'hinhanh' => 'required',
            'maloaiblog' => 'required',
        ]);

        $blog = BlogTour::findOrFail($mablogtour);

        $blog->tieude = $request->input('tieude');
        $blog->noidung = $request->input('noidung');
        $blog->trangthaiblog = $request->input('trangthaiblog');
        $blog->maloaiblog = $request->input('maloaiblog');
        $blog->slug = Str::slug($request->tieude);
        $blog->updated_at = now();

        $imagePath = $this->updateImage($request, 'hinhanh', 'frontend/images/blog/uploads', $blog->hinhanh);
        $blog->hinhanh = $imagePath;

        $blog->save();

        return redirect()->route('blog.index')->with('success', 'Cập nhật blog thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = BlogTour::find($id)->delete();
        $this->deleteImage($blog->hinhanh);
        return response(['status' => 'success', 'message' => 'Xóa blog thành công']);
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'mablogtour' => 'required',
            'trangthaiblog' => 'required',
        ]);

        $tour = BlogTour::findOrFail($request->mablogtour);
        $tour->trangthaiblog = $request->trangthaiblog === 'true' ? 1 : 0;
        $tour->save();

        return response()->json(['message' => 'Trạng thái cập nhật thành công!']);
    }
}
