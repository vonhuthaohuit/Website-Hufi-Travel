<?php

namespace App\Providers;

use App\Models\BlogTour;
use App\Models\DanhGia;
use App\Models\DiemDuLich;
use App\Models\LoaiTour;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['index', 'frontend.tour.all-tour', 'frontend.tour.tour-detail'], function ($view) {
            $tours = Tour::query()
                ->leftJoin('chitiettour', 'tour.matour', '=', 'chitiettour.matour')
                ->leftJoin('diemdulich', 'chitiettour.madiemdulich', '=', 'diemdulich.madiemdulich')
                ->leftJoin('danhgia', 'tour.matour', '=', 'danhgia.matour')
                ->select('tour.*', 'diemdulich.tendiemdulich', DB::raw('AVG(danhgia.diemdanhgia) as avg_rating'))
                ->where('tour.tinhtrang', 1)
                ->groupBy('tour.matour')
                ->paginate(6);

            $view->with('tours', $tours);
        });

        View::composer('*', function ($view) {
            $destinationHeader = DiemDuLich::all();

            $view->with('destinationHeader', $destinationHeader);
        });

        View::composer('*', function ($view) {
            $listTours = LoaiTour::query()
                ->select('tenloai')->get();

            $view->with('listTours', $listTours);
        });

        // View::composer('*', function ($view) {
        //     $khuyenmai = Tour::query()
        //         ->leftJoin('khuyenmai', 'tour.makhuyenmai', '=', 'khuyenmai.makhuyenmai')
        //         ->select('khuyenmai.*')
        //         ->where('tour.tinhtrang', 1)
        //         ->get();

        //         $giagoc = $tours->giatour;
        //         $phantramgiam = $tours->phantramgiam;
        //         $giagiam = $giagoc - ($giagoc * $phantramgiam) / 100;
        // })
    }
}
