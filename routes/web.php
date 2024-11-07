<?php

use App\Http\Controllers\backend\KhuyenMaiController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\backend\DiemDuLichController;
use App\Http\Controllers\backend\HomeController as BackendHomeController;
use App\Http\Controllers\frontend\TourController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\dattour\DatTourController;
use App\Http\Controllers\backend\BlogController;
use App\Http\Controllers\backend\FooterGridOneController;
use App\Http\Controllers\backend\FooterGridThreeController;
use App\Http\Controllers\backend\FooterGridTwoController;
use App\Http\Controllers\backend\FooterSocialController;
use App\Http\Controllers\backend\ChiTietTourController;
use App\Http\Controllers\backend\ChuongTrinhTourController;
use App\Http\Controllers\backend\ChuongTrinhTourController;
use App\Http\Controllers\backend\KhachSan_TourController;
use App\Http\Controllers\backend\KhachSanController;
use App\Http\Controllers\backend\LoaiBlogController;
use App\Http\Controllers\backend\LoaiTourController;
use App\Http\Controllers\backend\SubscriberController;
use App\Http\Controllers\backend\PhanCongCongViecController;
use App\Http\Controllers\backend\PhuongTien_TourController;
use App\Http\Controllers\backend\PhuongTienController;
use App\Http\Controllers\backend\TourController as BackendTourController;
use App\Http\Controllers\thanhtoan\ThanhToanMomoController;
use App\Http\Controllers\thanhtoan\ThanhToanVNPayController;
use App\Http\Controllers\frontend\BlogController as FrontendBlogController;
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



/*
|--------------------------------------------------------------------------
| Start route đặt tour
|--------------------------------------------------------------------------
*/
Route::post('/dattour', [DatTourController::class, 'index'])->name('tour.dattour');
Route::post('/xacnhanthongtindattour', [DatTourController::class, 'xacnhanthongtindattour'])->name("tour.xacnhanthongtindattour");


//Momo
Route::get('/momo-payment', [ThanhToanMomoController::class, 'createPayment'])->name('momo.payment');
Route::get('/momo-return', [ThanhToanMomoController::class, 'returnPayment'])->name('momo.return');

// Vnpay
Route::post('/vnpay-payment', [ThanhToanVNPayController::class, 'createPayment'])->name('vnpay.payment');
Route::get('/xacnhanthongtindattour/vnpay-returnPayment', [ThanhToanVNPayController::class, 'returnPayment'])->name('vnpay.returnPayment');

/*
|--------------------------------------------------------------------------
| End route đặt tour
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Start route search tour
|--------------------------------------------------------------------------
*/
Route::post('/search-tour', [\App\Http\Controllers\backend\TourController::class, 'searchTour'])->name('tour.search');

/*
|--------------------------------------------------------------------------
| End route search tour
|--------------------------------------------------------------------------
*/


// Login
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
    Route::delete('loaiblog/mass-destroy', [LoaiBlogController::class, 'massDestroy'])->name('loaiblog.massDestroy');

    Route::resource('footer-grid-one', FooterGridOneController::class);
    Route::resource('footer-grid-two', FooterGridTwoController::class);
    Route::post('footer-grid-two/change-status', [FooterGridTwoController::class, 'changeStatus'])->name('footer-grid-two.change-status');
    Route::post('footer-grid-two/change-title', [FooterGridTwoController::class, 'changeTitle'])->name('footer-grid-two.change-title');

    Route::resource('footer-grid-three', FooterGridThreeController::class);
    Route::post('footer-grid-three/change-status', [FooterGridThreeController::class, 'changeStatus'])->name('footer-grid-three.change-status');
    Route::post('footer-grid-three/change-title', [FooterGridThreeController::class, 'changeTitle'])->name('footer-grid-three.change-title');

    Route::resource('footer-socials', FooterSocialController::class);
    Route::put('footer-socials/change-status', [FooterSocialController::class, 'changeStatus'])->name('footer-socials.change-status');

    Route::get('subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
    Route::delete('subscribers/{id}', [SubscriberController::class, 'destory'])->name('subscribers.destory');
    Route::post('subscribers-send-mail', [SubscriberController::class, 'sendMail'])->name('subscribers-send-mail');
});

Route::get('/blog/{slug}', [FrontendBlogController::class, 'blogDetail'])->name('blog.detail');
Route::get('/blog', [FrontendBlogController::class, 'blog'])->name('blog.blog-all');

Route::get('/gioi-thieu', [HomeController::class, 'about'])->name('about');
Route::get('/lien-he', [HomeController::class, 'contact'])->name('contact');
Route::get('/danh-sach-tour', [TourController::class, 'allTour'])->name('tour.all-tour');

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
