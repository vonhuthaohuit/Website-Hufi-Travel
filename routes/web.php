<?php

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\dattour\DatTourController;
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

Route::get('/google-sign-in', [ 
    LoginController::class , 
     'getGoogleSignInUrl'
 ])->name('GoogleSign');
 
 
 Route::get('/auth/login-google-callback', [
    LoginController::class ,  
     'loginCallback'
 ])->name('Callback');


 // Đặt tour

 Route::get('/dattour', [DatTourController::class, 'index'])->name("tour.dattour");
 Route::get('/xacnhanthongtindattour', [DatTourController::class, 'xacnhanthongtindattour'])->name("tour.xacnhanthongtindattour");
