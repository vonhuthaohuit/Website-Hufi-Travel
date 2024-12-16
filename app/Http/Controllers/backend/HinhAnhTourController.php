<?php

namespace App\Http\Controllers\backend;

use App\DataTables\HinhAnhTourDatattables;
use App\Http\Controllers\Controller;
use App\Models\HinhAnhTour;
use App\Models\Tour;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class HinhAnhTourController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(HinhAnhTourDatattables $dataTable, Request $request)
    {
        if (!$request->has('tour_id') || !Tour::where('matour', $request->tour_id)->exists()) {
            return redirect()->back()->with('error', 'Tour ID không hợp lệ hoặc không tồn tại.');
        }
        $tour = Tour::findOrFail($request->tour_id);

        return $dataTable->render('backend.tour.hinhanhtour.index', compact('tour'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        @$tours = Tour::where('tinhtrang', 1)->select('matour', 'tentour')->get();
        $tour = Tour::findOrFail($request->tour_id);
        return view('backend.tour.hinhanhtour.create', compact('tours', 'tour'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'duongdan' => 'required',
            'matour' => 'required',
            'tenhinh' => 'required',
        ]);

        $imagePaths = $this->uploadMultiImage($request, 'duongdan', 'frontend/images/tour');

        if (empty($imagePaths)) {
            return back()->withErrors(['duongdan' => 'Hình ảnh không được tải lên.']);
        }

        foreach ($imagePaths as $key => $imagePath) {
            $hinhanhtour = new HinhAnhTour();
            $hinhanhtour->duongdan = $imagePath;
            $hinhanhtour->matour = $request->matour;
            $hinhanhtour->tenhinh = $request->tenhinh . ' - ' . ($key + 1);
            $hinhanhtour->save();
        }

        return redirect()->route('hinhanhtour.index', ['tour_id' => $request->matour])->with('success', 'Thêm hình ảnh thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $matour)
    {
        $hinhanhtour = HinhAnhTour::findOrFail($id);
        $selectedTour = Tour::where('matour', $hinhanhtour->matour)->first();
        $tours = Tour::where('tinhtrang', 1)->select('matour', 'tentour')->get();
        return view('backend.tour.hinhanhtour.edit', compact('hinhanhtour', 'tours', 'selectedTour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'duongdan' => 'required',
                'matour' => 'required',
                'tenhinh' => 'nullable',
            ]);

            $hinhanhtour = HinhAnhTour::findOrFail($id);

            $hinhanhtour->duongdan = $request->tenhinh;
            $hinhanhtour->matour = $request->matour;
            if ($request->hasFile('duongdan')) {
                $imagePath = $this->updateImage($request, 'duongdan', 'frontend/images/tour/uploads', $hinhanhtour->duongdan);
                $hinhanhtour->duongdan = $imagePath;
            } else {
                $hinhanhtour->duongdan = $hinhanhtour->duongdan;
            }

            $hinhanhtour->save();
            return redirect()->route('hinhanhtour.index', ['tour_id' => $request->matour])->with('success', 'Cập nhật hình ảnh thành công!');
        } catch (\Exception $e) {
            return redirect()->route('hinhanhtour.index', ['tour_id' => $request->matour])->with(['error', 'Cập nhật hình ảnh thất bại!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hinhanhtour = HinhAnhTour::find($id);
        $this->deleteImage($hinhanhtour->duongdan);
        $hinhanhtour->delete();
        return response(['status' => 'success', 'message' => 'Xóa hình ảnh thành công!']);
    }
}
