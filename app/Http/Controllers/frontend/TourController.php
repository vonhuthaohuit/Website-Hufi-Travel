<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\DanhGia;
use App\Models\DiemDuLich;
use App\Models\LoaiTour;
use App\Models\Tour;
use Illuminate\Http\Request;
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
            ->select('tour.*', 'chitiettour.giachitiettour', 'chuongtrinhtour.mota', 'chuongtrinhtour.tieude', 'diemdulich.tendiemdulich', 'loaitour.tenloai', 'hinhanhtour.duongdan', 'khuyenmai.phantramgiam')
            ->where('tour.slug', $slug)
            ->first();

        $commentOfTour = DanhGia::query()
            ->join('tour', 'danhgia.matour', '=', 'tour.matour')
            ->join('khachhang', 'danhgia.makhachhang', '=', 'khachhang.makhachhang')
            ->where('tour.matour', $tour->matour)
            ->get();

        $averageRating = DanhGia::query()
            ->selectRaw('matour, AVG(diemdanhgia) as avg_rating, COUNT(*) as total_reviews')
            ->where('matour', $tour->matour)
            ->groupBy('matour')
            ->first();

        // dump($averageRating->avg_rating);

        return view('frontend.tour.tour-detail', compact('tour', 'commentOfTour', 'averageRating'));
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
                ->where('tinhtrang', 1)
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
                ->where('tinhtrang', 1)
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
}
