<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\LoaiTour;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index($slug) {
        $tour = Tour::query()
            ->leftJoin('chitiettour', 'tour.matour', '=', 'chitiettour.matour')
            ->leftJoin('diemdulich', 'chitiettour.madiemdulich', '=', 'diemdulich.madiemdulich')
            ->leftJoin('chuongtrinhtour', 'tour.matour', '=', 'chuongtrinhtour.matour')
            ->select('tour.*', 'chitiettour.giachitiettour', 'chuongtrinhtour.mota', 'chuongtrinhtour.tieude')
            ->where('tour.slug', $slug)
            ->first();

        return view('frontend.tour.tour-detail', compact('tour'));
    }

    public function allTour() {
        $tourCategories = LoaiTour::take(5)->get();
        return view('frontend.tour.all-tour', compact('tourCategories'));
    }
}
