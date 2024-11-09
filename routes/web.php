<?php

use App\Http\Controllers\backend\KhuyenMaiController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\backend\DiemDuLichController;
use App\Http\Controllers\backend\HomeController as BackendHomeController;
use App\Http\Controllers\frontend\TourController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\BlogController;
use App\Http\Controllers\backend\FooterGridOneController;
use App\Http\Controllers\backend\FooterGridThreeController;
use App\Http\Controllers\backend\FooterGridTwoController;
use App\Http\Controllers\backend\FooterSocialController;
use App\Http\Controllers\backend\ChiTietTourController;
use App\Http\Controllers\backend\ChuongTrinhTourController;
use App\Http\Controllers\backend\LoaiBlogController;
use App\Http\Controllers\backend\LoaiTourController;
use App\Http\Controllers\backend\SubscriberController;
use App\Http\Controllers\backend\TourController as BackendTourController;
use App\Http\Controllers\frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\frontend\CommentController;
use App\Models\ChiTietTour;
use App\Models\DiemDuLich;
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

Route::get('/tour-detail', [TourController::class, 'index'])->name('tour.detail');
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);



Route::get('/google-sign-in', [
    LoginController::class,
    'getGoogleSignInUrl'
])->name('GoogleSign');

Route::get('/auth/login-google-callback', [
    LoginController::class,
    'loginCallback'
])->name('Callback');


Route::get('/index', [LoginController::class, 'index'])->name('login_view');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/tour/{slug}', [TourController::class, 'index'])->name('tour.detail');
Route::get('/danh-sach-tour/search', [TourController::class, 'search'])->name('tour.search');

Route::get('/admin/dashboard', [BackendHomeController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [BackendHomeController::class, 'index'])->name('dashboard');
    Route::resource('tour', BackendTourController::class);
    Route::resource('diemdulich', DiemDuLichController::class);
    Route::post('tour/change-status', [BackendTourController::class, 'changeStatus'])->name('tour.change-status');
    Route::resource('chuongtrinhtour', ChuongTrinhTourController::class);
    Route::resource('chitiettour', ChiTietTourController::class);
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
Route::get('/search', [FrontendBlogController::class, 'search'])->name('blog.search');

Route::get('/gioi-thieu', [HomeController::class, 'about'])->name('about');
Route::get('/lien-he', [HomeController::class, 'contact'])->name('contact');
Route::get('/danh-sach-tour', [TourController::class, 'allTour'])->name('tour.all-tour');

Route::post('/comment/create', [CommentController::class, 'createComment'])->name('comment.insert');
