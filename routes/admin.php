<?php

use App\Http\Controllers\backend\TourController;
use Illuminate\Support\Facades\Route;

Route::resource('/tour', TourController::class);
