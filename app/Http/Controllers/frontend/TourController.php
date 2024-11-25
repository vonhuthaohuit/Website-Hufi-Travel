<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ChiTietTour;
use App\Models\DanhGia;
use App\Models\DiemDuLich;
use App\Models\KhachSan;
use App\Models\LoaiTour;
use App\Models\PhuongTien;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

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
            ->select('tour.*', 'chitiettour.giachitiettour', 'chuongtrinhtour.mota', 'chuongtrinhtour.tieude', 'diemdulich.tendiemdulich', 'loaitour.tenloai', 'hinhanhtour.duongdan', 'khuyenmai.phantramgiam', 'chitiettour.ngaybatdau')
            ->where('tour.slug', $slug)
            ->first();

        $commentOfTour = DanhGia::query()
            ->join('tour', 'danhgia.matour', '=', 'tour.matour')
            ->join('khachhang', 'danhgia.makhachhang', '=', 'khachhang.makhachhang')
            ->where('tour.matour', $tour->matour)
            ->where('danhgia.tinhtrang', 1)
            ->select('danhgia.*', 'khachhang.hoten')
            ->get();

        $averageRating = DanhGia::query()
            ->selectRaw('matour, AVG(diemdanhgia) as avg_rating, COUNT(*) as total_reviews')
            ->where('matour', $tour->matour)
            ->where('tinhtrang', 1)
            ->groupBy('matour')
            ->first();

        $ratings = DanhGia::selectRaw('diemdanhgia, COUNT(*) as count')
            ->where('matour', $tour->matour)
            ->where('tinhtrang', 1)
            ->groupBy('diemdanhgia')
            ->orderBy('diemdanhgia', 'DESC')
            ->get();

        $totalRatings = $ratings->sum('count');

        $completeRatings = collect([5, 4, 3, 2, 1])->map(function ($rating) use ($ratings, $totalRatings) {
            $existingRating = $ratings->firstWhere('diemdanhgia', $rating);
            return (object) [
                'diemdanhgia' => $rating,
                'count' => $existingRating->count ?? 0,
                'percentage' => $totalRatings > 0 ? (($existingRating->count ?? 0) / $totalRatings) * 100 : 0,
            ];
        });

        $ratingsWithPercentage = $completeRatings;

        $phuongtien = PhuongTien::query()
            ->join('chitietphuongtientour', 'phuongtien.maphuongtien', '=', 'chitietphuongtientour.maphuongtien')
            ->where('chitietphuongtientour.matour', $tour->matour)
            ->first();

        $khachsan = KhachSan::query()
            ->join('chitietkhachsantour', 'khachsan.makhachsan', '=', 'chitietkhachsantour.makhachsan')
            ->where('chitietkhachsantour.matour', $tour->matour)
            ->first();

        $ngaybatdau = ChiTietTour::where('matour', $tour->matour)->first();

        return view('frontend.tour.tour-detail', compact('tour', 'commentOfTour', 'averageRating', 'ratingsWithPercentage', 'totalRatings', 'phuongtien', 'ngaybatdau', 'khachsan'));
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
                ->leftJoin('danhgia', 'tour.matour', '=', 'danhgia.matour')
                ->select('tour.*', DB::raw('AVG(danhgia.diemdanhgia) as avg_rating'), DB::raw('COUNT(danhgia.madanhgia) as review_count'))
                ->where('tentour', 'like', '%' . $request->search_query . '%')
                ->where('tour.tinhtrang', 1)
                ->groupBy('tour.matour')
                ->orderBy('avg_rating', 'DESC') // Sắp xếp theo điểm đánh giá trung bình
                ->paginate(12);


            $tourCategories = LoaiTour::take(5)->get();
            $query = $request->search_query;
        } elseif ($request->has('category')) {
            $category = LoaiTour::where('tenloai', $request->category)->firstOrFail();

            $tours = Tour::with('loaitour')
                ->where('maloaitour', $category->maloaitour)
                ->leftJoin('danhgia', 'tour.matour', '=', 'danhgia.matour')
                ->where('tour.tinhtrang', 1)
                ->select(
                    'tour.*',
                    DB::raw('AVG(danhgia.diemdanhgia) as avg_rating'),
                    DB::raw('COUNT(danhgia.madanhgia) as review_count')
                )
                ->groupBy('tour.matour', 'tour.tentour', 'tour.tinhtrang', 'tour.maloaitour', 'tour.giatour') // Nhóm theo các cột của bảng `tour`
                ->orderBy('tour.matour', 'DESC')
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
