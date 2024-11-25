<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\DanhGia;
use App\Models\DiemDuLich;
use App\Models\LoaiTour;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class TourController extends Controller
{
    public function index($slug)
    {
        $tour = Tour::query()
            ->leftJoin('chitiettour', 'tour.matour', '=', 'chitiettour.matour')
            ->leftJoin('diemdulich', 'chitiettour.madiemdulich', '=', 'diemdulich.madiemdulich')
            ->leftJoin('chuongtrinhtour', 'tour.matour', '=', 'chuongtrinhtour.matour')
            ->leftJoin('hinhanhtour', 'tour.matour', '=', 'hinhanhtour.matour')
            ->leftJoin('loaitour', 'tour.maloaitour', '=', 'loaitour.maloaitour')
            ->leftJoin('khuyenmai', 'tour.makhuyenmai', '=', 'khuyenmai.makhuyenmai')
            ->select('tour.*', 'chitiettour.giachitiettour', 'chuongtrinhtour.mota', 'chuongtrinhtour.tieude', 'diemdulich.tendiemdulich', 'loaitour.tenloai', 'hinhanhtour.duongdan', 'khuyenmai.phantramgiam')
            ->where('tour.slug', $slug)
            ->first();

        $commentOfTour = DanhGia::query()
            ->join('tour', 'danhgia.matour', '=', 'tour.matour')
            ->join('khachhang', 'danhgia.makhachhang', '=', 'khachhang.makhachhang')
            ->where('tour.matour', $tour->matour)
            ->get();

        // dd($tour->makhuyenmai);

        return view('frontend.tour.tour-detail', compact('tour', 'commentOfTour'));
    }

    public function allTour()
    {
        $tourCategories = LoaiTour::take(5)->get();
        return view('frontend.tour.all-tour', compact('tourCategories'));
    }

    public function search(Request $request)
    {
        if ($request->has('search_query')) {
            $tours = Tour::with('chitiettour', 'loaitour', 'chuongtrinhtour')
                ->where('tentour', 'like', '%' . $request->search_query . '%')
                ->where('tinhtrang', 1)
                ->orderBy('matour', 'DESC')
                ->paginate(12);

            $tourCategories = LoaiTour::take(5)->get();
            $query = $request->search_query;
        } elseif ($request->has('category')) {
            $category = LoaiTour::where('tenloai', $request->category)->firstOrFail();

            $tours = Tour::with('loaitour')->where('maloaitour', $category->maloaitour)
                ->where('tinhtrang', 1)->orderBy('matour', 'DESC')
                ->paginate(12);

            $tourCategories = LoaiTour::take(5)->get();

            $query = $request->category;
        } else {
            // $blogs = BlogTour::with('loaiblog')->where('trangthaiblog', 1)->orderBy('mablogtour', 'DESC')->paginate(3);
        }

        $count = $tours->count();

        return view('frontend.tour.tourSearch', compact('tours',  'tourCategories', 'query', 'count'));
    }

    public function tourByDestination($slug)
    {
        $tour = Tour::query()
            ->leftJoin('chitiettour', 'tour.matour', '=', 'chitiettour.matour')
            ->leftJoin('diemdulich', 'chitiettour.madiemdulich', '=', 'diemdulich.madiemdulich')
            ->select('tour.*', 'diemdulich.tendiemdulich')
            ->where('diemdulich.tendiemdulich', $slug)
            ->paginate(12);

        $tenDiemDuLich = $slug;

        $tourCategories = LoaiTour::take(5)->get();

        return view('frontend.tour.tour-by-destination', compact('tour', 'tourCategories', 'tenDiemDuLich'));
    }
    public function tourSearchImageAI($request)
    {
        dd($request->all());
        $image = $request->file('image');

        $response = Http::attach(
            'image',
            file_get_contents($image->getRealPath()),
            $image->getClientOriginalName()
        )->post('http://.../search-image');

        $similarImages = $response->json();

        $imageFolder = public_path('frontend/images');

        $allImages = File::files($imageFolder);

        $matchedTours = [];
        foreach ($allImages as $file) {
            if (in_array($file->getFilename(), $similarImages)) {
                $tour = Tour::where('image_name', $file->getFilename())->first();
                if ($tour) {
                    $matchedTours[] = $tour;
                }
            }
        }

        return view('search-results', ['tours' => $matchedTours]);
    }
}
