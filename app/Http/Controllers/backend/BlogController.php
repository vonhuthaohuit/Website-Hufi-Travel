<?php

namespace App\Http\Controllers\backend;

use App\DataTables\BlogDatatables;
use App\Http\Controllers\Controller;
use App\Models\BlogTour;
use App\Models\LoaiBlog;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        if (Session::has('user')) {
            $user = Session::get('user');
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

            $nhanvien = NhanVien::where('mataikhoan', $user->mataikhoan)->first();

            $blog = new BlogTour();
            $blog->tieude = $request->tieude;
            $blog->slug = Str::slug($request->tieude);
            $blog->noidung = $request->noidung;
            $blog->trangthaiblog = $request->trangthaiblog;
            $blog->maloaiblog = $request->maloaiblog;
            $blog->manhanvien = $nhanvien->manhanvien;
            $blog->hinhanh = $imagePath;
            // $blog->user_id = Auth::user()->id;
            $blog->save();
            return redirect()->route('blog.index');
        }
        return redirect()->route('dashboard');
    }
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
        if (Session::has('user')) {
            $user = Session::get('user');
            $request->validate([
                'tieude' => 'required|string|max:255',
                'noidung' => 'required',
                'trangthaiblog' => 'required',
                'maloaiblog' => 'required',
            ]);

            $blog = BlogTour::findOrFail($mablogtour);
            $blog->tieude = $request->input('tieude');
            $blog->slug = Str::slug($request->tieude);
            $blog->noidung = $request->input('noidung');
            $blog->trangthaiblog = $request->input('trangthai');
            $blog->maloaiblog = $request->input('maloaiblog');
            // $blog->manhanvien = $user->manhanvien;
            $blog->updated_at = now();

            if ($request->hasFile('hinhanh')) {
                $imagePath = $this->updateImage($request, 'hinhanh', 'frontend/images/blog/uploads', $blog->hinhanh);
                $blog->hinhanh = $imagePath;
            } else {
                $blog->hinhanh = $blog->hinhanh;
            }

            $blog->save();

            return redirect()->route('blog.index')->with('success', 'Cập nhật blog thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mablogtour)
    {
        $blog = BlogTour::find($mablogtour);
        $this->deleteImage($blog->hinhanh);
        $blog->delete();
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
