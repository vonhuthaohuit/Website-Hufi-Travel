<?php

namespace App\Providers;

<<<<<<< HEAD
=======
use App\Models\ChiTietTour;
>>>>>>> defd6178187e7f82d845c64663e85e99dc01a35f
use App\Models\Tour;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        View::composer(['index', 'frontend.tour.all-tour', 'frontend.tour.tour-detail'], function ($view) {
            $tours = Tour::query()
                ->leftJoin('chitiettour', 'tour.matour', '=', 'chitiettour.matour')
                ->select('tour.*', DB::raw('MIN(chitiettour.giachitiettour) as giachitiettour'))
                ->where('tour.tinhtrang', 1)
                ->groupBy('tour.matour')
                ->paginate(6);

            $view->with('tours', $tours);
        });
=======

>>>>>>> defd6178187e7f82d845c64663e85e99dc01a35f
    }
}
