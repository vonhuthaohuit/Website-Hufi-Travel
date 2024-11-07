<?php

use App\Http\Controllers\backend\KhuyenMaiController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\backend\DiemDuLichController;
use App\Http\Controllers\backend\HomeController as BackendHomeController;
use App\Http\Controllers\frontend\TourController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\BlogController;
use App\Http\Controllers\backend\ChiTietTourController;
use App\Http\Controllers\backend\ChuongTrinhTourController;
use App\Http\Controllers\backend\KhachSan_TourController;
use App\Http\Controllers\backend\KhachSanController;
use App\Http\Controllers\backend\LoaiBlogController;
use App\Http\Controllers\backend\LoaiTourController;
use App\Http\Controllers\backend\PhanCongCongViecController;
use App\Http\Controllers\backend\PhuongTien_TourController;
use App\Http\Controllers\backend\PhuongTienController;
use App\Http\Controllers\backend\TourController as BackendTourController;
use App\Models\ChiTietTour;
use App\Models\DiemDuLich;
use App\Models\KhachSan_Tour;
use App\Models\PhuongTien_Tour;
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
])->name('home');

Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);



Route::get('/google-sign-in', [
    LoginController::class,
    'getGoogleSignInUrl'
])->name('GoogleSign');

Route::get('/auth/login-google-callback', [
    LoginController::class,
    'loginCallback'
])->name('Callback');
Route::get('/tour-detail', [TourController::class, 'index'])->name('tour.detail');

Route::post('/login', [LoginController::class, 'login'])->name('login');



Route::get('/index', [LoginController::class, 'index'])->name('login_view');
Route::post('/register', [LoginController::class, 'register'])->name('register');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');






Route::prefix('admin')->group(function () {
    Route::resource('tour', BackendTourController::class);
    Route::post('tour/change-status', [BackendTourController::class, 'changeStatus'])->name('tour.change-status');
    Route::get('/dashboard', [BackendHomeController::class, 'index'])->name('dashboard');


    Route::resource('diemdulich', DiemDuLichController::class);
    Route::resource('khachsan', KhachSanController::class);
    Route::resource('phuongtien', PhuongTienController::class);


    Route::resource('chuongtrinhtour', ChuongTrinhTourController::class);
    Route::post(' chuongtrinhtour/{id}', [ChuongTrinhTourController::class, 'getChuongTrinhByTour'])->name('chuongtrinhtour.byTour');
    Route::resource('loaitour', LoaiTourController::class);
    Route::resource('khuyenmai', KhuyenMaiController::class);
    Route::resource('blog', BlogController::class);
    Route::post('blog/change-status', [BlogController::class, 'changeStatus'])->name('blog.change-status');
    Route::resource('loaiblog', LoaiBlogController::class);

    Route::resource('phuongtien_tour', PhuongTien_TourController::class);
    Route::get('phuongtien_tour/edit/{id}/{maphuongtien}', [PhuongTien_TourController::class, 'edit'])->name('phuongtien_tour.edit');
    Route::delete('admin/phuongtien_tour/delete/{id}/{maphuongtien}', [PhuongTien_TourController::class, 'destroy'])->name('phuongtien_tour.delete');

    Route::resource('khachsan_tour', KhachSan_TourController::class);
    Route::get('khachsan_tour/edit/{id}/{makhachsan}', [KhachSan_TourController::class, 'edit'])->name('khachsan_tour.edit');
    Route::delete('admin/khachsan_tour/delete/{id}/{makhachsan}', [KhachSan_TourController::class, 'destroy'])->name('khachsan_tour.delete');

    Route::resource('chitiettour', ChiTietTourController::class);
    Route::get('chitiettour/edit/{id}/{madiemdulich}', [ChiTietTourController::class, 'edit'])->name('chitiettour.edit');
    Route::delete('admin/chitiettour/delete/{id}/{madiemdulich}', [ChiTietTourController::class, 'destroy'])->name('chitiettour.delete');
    Route::get('/phancongcongviec', [PhanCongCongViecController::class, 'index'])->name('phancong');

    Route::prefix('nhanvien')->group(function ()
    {
    Route::get('/dashboard', [BackendHomeController::class, 'nhanvien_home'])->name('dashboard');


    });
});



// Route::middleware('user')->group(function()
// {


// })
