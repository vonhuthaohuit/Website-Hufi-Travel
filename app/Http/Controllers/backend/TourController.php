<?php

namespace App\Http\Controllers\backend;

use App\DataTables\TourDatatables;
use App\Http\Controllers\Controller;
use App\Models\KhuyenMai;
use App\Models\LoaiTour;
use App\Models\Tour;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TourController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(TourDatatables $dataTable)
    {
        return $dataTable->render('backend.tour.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loaiTour = LoaiTour::all();
        $khuyenMai = KhuyenMai::all();
        return view('backend.tour.create', compact('loaiTour', 'khuyenMai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tentour' => 'required',
            'motatour' => 'required',
            'tinhtrang' => 'required',
            'giatour' =>'required',
            'noikhoihanh' => 'required',
            'loaitour_id' => 'required|exists:loaitour,maloaitour',
            'khuyenmai_id' => 'nullable|exists:khuyenmai,makhuyenmai',
            'hinhdaidien' => 'required|image',
        ]);

        $imagePath = $this->uploadImage($request, 'hinhdaidien', 'frontend/images/tour');
        if (!$imagePath) {
            return back()->withErrors(['hinhdaidien' => 'Hình ảnh không được tải lên.']);
        }
        $khuyenmai_ID = $request->khuyenmai_id ;
        if(!$khuyenmai_ID)
        {
            $khuyenmai_ID = null ;
        }
        $tour = new Tour();
        $tour->tentour = $request->tentour;
        $tour->slug = Str::slug($request->tentour);
        $tour->motatour = $request->motatour;
        $tour->tinhtrang = $request->tinhtrang;
        $tour->giatour = $request->giatour;
        $tour->noikhoihanh = $request->noikhoihanh;
        $tour->thoigiandi = $request->thoigiandi;
        $tour->maloaitour = $request->loaitour_id;
        $tour->makhuyenmai = $request->khuyenmai_id;
        $tour->hinhdaidien = $imagePath;
        $tour->created_at = now() ;
        $tour->updated_at = now() ;
        $tour->save();
        DB::statement('CALL updateTourStatus(?)', [$tour->matour]);
        return redirect()->route('tour.index');
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
        $tour = Tour::where('matour',$id)->first();
        $khuyenMai = KhuyenMai::all();
        $loaiTour = LoaiTour::all();
        return view('backend.tour.edit', compact('tour', 'khuyenMai', 'loaiTour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tentour' => 'required|string|max:255',
            'motatour' => 'required|string',
            'tinhtrang' => 'required|string|max:100',
            'thoigiandi' => 'required',
            'giatour' =>'required',
            'hinhdaidien' => 'nullable|image',
            'noikhoihanh' => 'required|string|max:255',
            'loaitour_id' => 'required|exists:loaitour,maloaitour',
            'khuyenmai_id' => 'nullable|exists:khuyenmai,makhuyenmai',
        ]);

        $tour = Tour::where('matour',$id)->first();
        $tour->tentour = $request->input('tentour');
        $tour->slug = Str::slug($request->tentour);
        $tour->motatour = $request->input('motatour');
        $tour->tinhtrang = $request->input('tinhtrang');
        $tour->thoigiandi = $request->input('thoigiandi');
        $tour->giatour = $request->giatour;
        $tour->noikhoihanh = $request->input('noikhoihanh');
        $tour->maloaitour = $request->input('loaitour_id');
        $tour->makhuyenmai = $request->input('khuyenmai_id');
        $tour->updated_at = now() ;
        if ($request->hasFile('hinhdaidien')) {
            if ($tour->hinhdaidien) {
                Storage::delete($tour->hinhdaidien);
            }

            $path = $request->file('hinhdaidien')->store('frontend/images/tour', 'public');
            $tour->hinhdaidien = $path;
        }

        $tour->save();
        return redirect()->route('tour.index')->with('success', 'Cập nhật tour thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tour = Tour::find($id)->delete();
        $this->deleteImage($tour->hinhdaidien);
        return response(['status' => 'success', 'message' => 'Xóa thành công']);
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'tinhtrang' => 'required',
        ]);
        $tour = Tour::findOrFail($request->id);
        $tour->tinhtrang = $request->tinhtrang === 'true' ? 1 : 0;
        $tour->save();
        return response()->json(['message' => 'Tình trạng cập nhật thành công!']);
    }


    public function countChuongTrinhTourofTour()
    {

    }


}
