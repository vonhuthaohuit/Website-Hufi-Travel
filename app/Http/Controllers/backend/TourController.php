<?php

namespace App\Http\Controllers\backend;

use App\DataTables\TourDatatables;
use App\Http\Controllers\Controller;
use App\Models\ChiTietTour;
use App\Models\DiemDuLich;
use App\Models\KhuyenMai;
use App\Models\LoaiTour;
use App\Models\Tour;
use App\Traits\ImageUploadTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
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
            'noikhoihanh' => 'required',
            'loaitour_id' => 'required|exists:loaitour,id',
            'khuyenmai_id' => 'nullable|exists:khuyenmai,id',
            'hinhdaidien' => 'required|image',
        ]);

        $imagePath = $this->uploadImage($request, 'hinhdaidien', 'frontend/images/tour');
        if (!$imagePath) {
            return back()->withErrors(['hinhdaidien' => 'Hình ảnh không được tải lên.']);
        }
        $khuyenmai_ID = $request->khuyenmai_id;
        if (!$khuyenmai_ID) {
            $khuyenmai_ID = null;
        }
        $tour = new Tour();
        $tour->tentour = $request->tentour;
        $tour->slug = Str::slug($request->tentour);
        $tour->motatour = $request->motatour;
        $tour->tinhtrang = $request->tinhtrang;
        $tour->noikhoihanh = $request->noikhoihanh;
        $tour->loaitour_id = $request->loaitour_id;
        $tour->khuyenmai_id = $request->khuyenmai_id;
        $tour->hinhdaidien = $imagePath;
        $tour->created_at = now();
        $tour->updated_at = now();
        $tour->save();
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
        $tour = Tour::findOrFail($id);
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
            'hinhdaidien' => 'nullable|image',
            'noikhoihanh' => 'required|string|max:255',
            'loaitour_id' => 'required|exists:loaitour,id',
            //'khuyenmai_id' => 'nullable|exists:khuyenmai,id',
        ]);

        $tour = Tour::findOrFail($id);

        $tour->tentour = $request->input('tentour');
        $tour->slug = Str::slug($request->tentour);
        $tour->motatour = $request->input('motatour');
        $tour->tinhtrang = $request->input('tinhtrang');
        $tour->noikhoihanh = $request->input('noikhoihanh');
        $tour->loaitour_id = $request->input('loaitour_id');
        $tour->khuyenmai_id = $request->input('khuyenmai_id');
        $tour->ngaytao = now();


        $imagePath = $this->updateImage($request, 'hinhdaidien', 'frontend/images/tour/uploads', $tour->hinhdaidien);
        $tour->hinhdaidien = $imagePath;

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

    public function searchTour(Request $request)
    {
        $searchData = $request->only(['typetour', 'destination', 'departure', 'date-start', 'date-end', 'duration', 'guests']);
        if (!empty($searchData['date-start']) || !empty($searchData['date-end'])) {
            $searchData['date-start'] = Carbon::parse($searchData['date-start'])->format('Y-m-d');
            $searchData['date-end'] = Carbon::parse($searchData['date-end'])->format('Y-m-d');
        }

        $tours = Tour::query()
            ->where('tinhtrang', 1)
            ->when($searchData['typetour'], function ($query, $typetour) {
                $query->where('maloaitour', $typetour);
            })
            ->when($searchData['destination'], function ($query, $destination) {
                $query->whereHas('chitiettour.diemdulich', function ($q) use ($destination) {
                    $q->where('madiemdulich', $destination);
                });
            })
            ->when($searchData['departure'], function ($query, $departure) {
                $query->where('noikhoihanh', 'like', '%' . $departure . '%');
            })
            ->when($searchData['duration'], function ($query, $duration) {
                $query->where('thoigiandi', 'like', '%' . $duration . '%');
            })
            ->when($searchData['date-start'], function ($query, $date) {
                $query->whereHas('chitiettour', function ($q) use ($date) {
                    $q->where('ngaybatdau', $date);
                });
            })
            ->when($searchData['date-end'], function ($query, $date) {
                $query->whereHas('chitiettour', function ($q) use ($date) {
                    $q->where('ngayketthuc', $date);
                });
            })

            ->with([
                'khuyenmai',
                'loaitour',
                'hinhanhtour',
                'chitiettour',
                'chuongtrinhtour',
                'khachsan_tour',
                'phuongtien_tour'
            ])
            ->get();
        return view('backend.tour.searchtour', compact('tours'));
    }
}
