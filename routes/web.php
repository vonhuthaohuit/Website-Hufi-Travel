<?php

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\backend\HomeController as BackendHomeController;
use App\Http\Controllers\frontend\TourController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [
    HomeController::class,
    "index"
]);


Route::get('/login', [LoginController::class, 'login'])->name("auth.login");

Route::get('/tour-detail', [TourController::class, 'index'])->name('tour.detail');

Route::get('/admin/dashboard', [BackendHomeController::class, 'index']);
