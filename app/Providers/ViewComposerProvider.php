<?php

namespace App\Providers;

use App\Models\BlogTour;
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
                ->select('tour.*', DB::raw('MIN(chitiettour.giachitiettour) as giachitiettour'))
                ->where('tour.tinhtrang', 1)
                ->groupBy('tour.matour')
                ->paginate(6);

            $view->with('tours', $tours);
        });
    }
}
