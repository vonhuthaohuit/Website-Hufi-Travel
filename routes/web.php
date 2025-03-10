<?php

use App\DataTables\PhanCongNhanVienDataTable;
use App\Http\Controllers\backend\KhuyenMaiController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\backend\DiemDuLichController;
use App\Http\Controllers\backend\HomeController as BackendHomeController;
use App\Http\Controllers\frontend\TourController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\BackupAndRestoreControlelr;
use App\Http\Controllers\dattour\DatTourController;
use App\Http\Controllers\backend\BlogController;
use App\Http\Controllers\backend\FooterGridOneController;
use App\Http\Controllers\backend\FooterGridThreeController;
use App\Http\Controllers\backend\FooterGridTwoController;
use App\Http\Controllers\backend\FooterSocialController;
use App\Http\Controllers\backend\ChiTietTourController;
use App\Http\Controllers\backend\ChucVuController;
use App\Http\Controllers\backend\NhanVienController;
use App\Http\Controllers\backend\NhomQuyenController;
use App\Http\Controllers\backend\PhanCongChucVuController;
use App\Http\Controllers\backend\PhanCongNhanVienController;
use App\Http\Controllers\backend\PhongBanController;
use App\Http\Controllers\backend\Quyen_NhomQuyenController;
use App\Http\Controllers\backend\QuyenController;
use App\Http\Controllers\backend\ChuongTrinhTourController;
use App\Http\Controllers\backend\DanhGiaController;
use App\Http\Controllers\backend\HinhAnhTourController;
use App\Http\Controllers\Backend\KhachHangController;
use App\Http\Controllers\backend\KhachSan_TourController;
use App\Http\Controllers\backend\KhachSanController;
use App\Http\Controllers\backend\PhanCongCongViecController;
use App\Http\Controllers\backend\PhuongTien_TourController;
use App\Http\Controllers\backend\PhuongTienController;
use App\Http\Controllers\backend\LoaiBlogController;
use App\Http\Controllers\backend\LoaiTourController;
use App\Http\Controllers\backend\nhanvien\DashboardController;
use App\Http\Controllers\backend\PhieuHuyController as BackendPhieuHuyController;
use App\Http\Controllers\backend\StatisticController;
use App\Http\Controllers\backend\SubscriberController;
use App\Http\Controllers\backend\TaiKhoanController;
use App\Http\Controllers\backend\TaiKhoanNVController;
use App\Http\Controllers\backend\TourController as BackendTourController;
use App\Http\Controllers\backend\UserBEController;
use App\Http\Controllers\thanhtoan\ThanhToanMomoController;
use App\Http\Controllers\thanhtoan\ThanhToanVNPayController;
use App\Http\Controllers\frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\frontend\CommentController;
use App\Http\Controllers\frontend\PhieuHuyController;
use App\Http\Controllers\thanhtoan\HoaDonController;
use App\Http\Controllers\thanhtoan\PhieuDatTourController;
use App\Http\Controllers\thanhtoan\PhieuHuyTourController;
use App\Models\ChiTietTour;
use App\Models\DiemDuLich;
use App\Models\KhachHang;
use App\Models\KhachSan_Tour;
use App\Models\NhomQuyen;
use App\Models\PhanCongChucVu;
use App\Models\PhanCongNhanVien;
use App\Models\PhuongTien_Tour;
use App\Models\Quyen_Nhomquyen;
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

Route::get('/google-sign-in', [
    LoginController::class,
    'getGoogleSignInUrl'
])->name('GoogleSign');

Route::get('/auth/login-google-callback', [
    LoginController::class,
    'loginCallback'
])->name('Callback');

Route::post('/login', [LoginController::class, 'login'])->name('PostLogin');


Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    /*
    |----------------------------------------------------------------------
    | Start route đặt tour
    |----------------------------------------------------------------------
    */
    Route::post('/dattour', [DatTourController::class, 'index'])
        ->name('tour.dattour')
        ->middleware('check.post');

    Route::post('/xacnhanthongtindattour', [DatTourController::class, 'xacnhanthongtindattour'])
        ->name('tour.xacnhanthongtindattour')
        ->middleware('check.post');
    Route::post('/step4', [DatTourController::class, 'tieptucdattour'])
        ->name('tour.step4')
        ->middleware('check.post');

    // Momo
    Route::post('/momo-payment', [ThanhToanMomoController::class, 'createPayment'])->name('momo.payment');
    Route::get('/momo-return', [ThanhToanMomoController::class, 'returnPayment'])->name('momo.return');

    // Vnpay
    Route::post('/vnpay-payment', [ThanhToanVNPayController::class, 'createPayment'])->name('vnpay.payment');
    Route::get('/xacnhanthongtindattour/vnpay-returnPayment', [ThanhToanVNPayController::class, 'returnPayment'])->name('vnpay.returnPayment');

    /*
    |----------------------------------------------------------------------
    | End route đặt tour
    |----------------------------------------------------------------------
    */
});



/*
|--------------------------------------------------------------------------
| Start route search tour
|--------------------------------------------------------------------------
*/

Route::post('/search-tour', [\App\Http\Controllers\backend\TourController::class, 'searchTour'])->name('tour.searchbox');
Route::post('/search-image', [TourController::class, 'tourSearchImageAI'])->name('search.image');
Route::post('/test', [DatTourController::class, 'test'])->name('test');

/*
|--------------------------------------------------------------------------
| End route search tour
|--------------------------------------------------------------------------
*/


// Login
Route::get('/login', [LoginController::class, 'index'])->name('login_view');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/forget-password',[ResetPasswordController::class,'forgetPassword'])->name('auth.forget') ;
Route::post('/forget-password',[ResetPasswordController::class,'forgetPasswordPost'])->name('auth.forget.post') ;

Route::get('/reset-password/{token}',[ResetPasswordController::class,'resetPassword'])->name('auth.reset') ;
Route::post('/reset-password',[ResetPasswordController::class,'resetPasswordPost'])->name('auth.reset.post') ;



Route::get('/danh-sach-tour/search', [TourController::class, 'search'])->name('tour.search');


Route::get('/tour/{slug}', [TourController::class, 'index'])->name('tour.detail');


Route::prefix('admin')->middleware(['auth', 'is.admin'])->group(function () {
    Route::get('/dashboard', [BackendHomeController::class, 'index'])->name('dashboard');
    Route::resource('tour', BackendTourController::class);
    Route::post('tour/change-status', [BackendTourController::class, 'changeStatus'])->name('tour.change-status');


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

    Route::get('/danhsachtour', [PhanCongNhanVienController::class, 'danhsachtour'])->name('danhsachtour');
    Route::resource('phancongnhanvien', PhanCongNhanVienController::class);
    Route::resource('chucvu', ChucVuController::class);
    Route::resource('nhanvien', NhanVienController::class);
    Route::resource('phongban', PhongBanController::class);
    Route::resource('phancongchucvu', PhanCongChucVuController::class);
    Route::delete('phancongchucvu/delete/{id}/{machucvu}', [PhanCongChucVuController::class, 'destroy'])->name('phancongchucvu.delete');
    Route::resource('quyen', QuyenController::class);
    Route::resource('nhomquyen', NhomQuyenController::class);
    Route::get('quyen_nhomquyen/{manhomquyen}', [Quyen_NhomQuyenController::class, 'index'])->name('quyen_nhomquyen.index');
    Route::get('quyen_nhomquyen/create/{manhomquyen}', [Quyen_NhomQuyenController::class, 'create'])->name('quyen_nhomquyen.create');
    Route::post('quyen_nhomquyen', [Quyen_NhomQuyenController::class, 'store'])->name('quyen_nhomquyen.store');

    Route::delete('quyen_nhomquyen/delete/{id}/{maquyen}', [Quyen_NhomQuyenController::class, 'destroy'])->name('quyen_nhomquyen.delete');
    Route::get('/chon-nhan-vien/{tenchucvu}', [PhanCongNhanVienController::class, 'chonNhanVienTheoChucVu'])->name('chon-nhan-vien');
    Route::post('/phan-cong-nhan-vien', [PhanCongNhanVienController::class, 'store']);
    Route::delete('phancongnhanvien/delete/{id}/{manhanvien}', [PhanCongNhanVienController::class, 'destroy'])->name('phancongnhanvien.delete');
    Route::get('phancongnhanvien/dsNhanVien/{matour}', [PhanCongNhanVienController::class, 'layDSNhanVienTheoTour'])->name('phancongnhanvien.dsNhanVien');



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

    //Thống kê báo cáo
    Route::get('statistic/khachhang/index',[StatisticController::class,'viewStatisticKhachHang'])->name('statistic.khachhang.index') ;
    Route::get('statistic/khachhang',[StatisticController::class,'statisticKhachHang'])->name('statistic.khachhang');
    Route::get('statistic/doanhthu',[StatisticController::class,'viewstatisticDoanhThu'])->name('statistic.doanhthu');
    // Sao lưu phục hồi
    Route::get('backup-restore', [BackupAndRestoreControlelr::class, 'index'])->name('backup.index');
    Route::get('/backup', [BackupAndRestoreControlelr::class, 'backup'])->name('backup.create');
    Route::post('restore', [BackupAndRestoreControlelr::class, 'restore'])->name('backup.restore');
    Route::post('restore-schedule', [BackupAndRestoreControlelr::class, 'scheduleBackup'])->name('backup.schedule');
    Route::post('remove-schedule', [BackupAndRestoreControlelr::class, 'removeSchedules'])->name('backup.remove');
    // profile

    Route::get('profile-admin', [BackendHomeController::class, 'profile'])->name('ad.profile');
    Route::post('profile-update', [BackendHomeController::class, 'updateProfile'])->name('ad.profile.update');

    // Hoá đơn, phiếu đặt tour
    Route::get('hoadon', [HoaDonController::class, 'index'])->name('hoadon.index');
    Route::get('phieudattour', [PhieuDatTourController::class, 'index'])->name('phieudattour.index');
    Route::get('phieuhuytour', [PhieuHuyTourController::class, 'index'])->name('phieuhuytour.index');
    Route::resource('phieuhuytour', PhieuHuyTourController::class);

    Route::resource('hoadon', HoaDonController::class);

    Route::resource('danhgia', DanhGiaController::class);
    Route::post('danhgia/change-status', [DanhGiaController::class, 'changeStatus'])->name('danhgia.change-status');

    Route::resource('phieuhuytour', BackendPhieuHuyController::class);
    Route::resource('hinhanhtour', HinhAnhTourController::class);
    Route::get('hinhanhtour/edit/{id}/{matour}', [HinhAnhTourController::class, 'edit'])->name('hinhanhtour.edit');

    Route::resource('taikhoan', TaiKhoanController::class);
    Route::post('taikhoan/change-status', [TaiKhoanController::class, 'changeStatus'])->name('taikhoan.change-status');

    Route::resource('taikhoannv', TaiKhoanNVController::class);
    Route::post('taikhoannv/change-status', [TaiKhoanNVController::class, 'changeStatus'])->name('taikhoannv.change-status');
});
Route::get('upload-model-ai/index', [App\Http\Controllers\backend\UploadModelAI::class, 'index'])->name('upload.model.ai.index');
Route::get('upload-model-ai', [App\Http\Controllers\backend\UploadModelAI::class, 'upLoadModel'])->name('upload.model.ai');
Route::get('hoadon/{hoaDonId}/print', [HoaDonController::class, 'printInvoice'])->name('hoadon.print');

Route::get('/get-chi-tiet-tour/{tourId}', [HoaDonController::class, 'getChiTietTour'])->name('get.chitiettour');
Route::get('/get-customer-price/{age}/{tourId}', [HoaDonController::class, 'getCustomerPrice']);
Route::post('/check-cccd', [KhachHangController::class, 'validateCCCD'])->name('check.cccd');
Route::get('/get-users', [UserBEController::class, 'getUsers'])->name('get.users');
Route::get('/get-khachhang-details/{userId}', [KhachHangController::class, 'getKhachHangDetails'])->name('get.khachhang.details');
Route::get('/get-tour-details/{tourId}', [\App\Http\Controllers\backend\TourController::class, 'getTourDetails']);

Route::get('/blog/{slug}', [FrontendBlogController::class, 'blogDetail'])->name('blog.detail');
Route::get('/blog', [FrontendBlogController::class, 'blog'])->name('blog.blog-all');
Route::get('/search', [FrontendBlogController::class, 'search'])->name('blog.search');

Route::prefix('nhanvien')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('nv.dashboard');
    Route::resource('loaitour', LoaiTourController::class);
    Route::resource('khuyenmai', KhuyenMaiController::class);
    Route::resource('blog', BlogController::class, ['as' => 'nv']);
});

// Route::middleware('user')->group(function()
// {


// })
Route::get('/gioi-thieu', [HomeController::class, 'about'])->name('about');
Route::get('/lien-he', [HomeController::class, 'contact'])->name('contact');
Route::get('/danh-sach-tour', [TourController::class, 'allTour'])->name('tour.all-tour');

Route::post('/comment/create', [CommentController::class, 'createComment'])->name('comment.insert');
Route::get('/dia-diem/{slug}', [TourController::class, 'tourByDestination'])->name('tour.byDestination');
Route::get('/transaction', [HomeController::class, 'transaction'])->name('transaction');
Route::get('/history/tour-order/{matour}/{maphieudattour}', [HomeController::class, 'tourOrder'])->name('tour.tourOrder');
Route::get('/history/tour-booked', [HomeController::class, 'tourBooked'])->name('tour.tour-booked');
Route::delete('/history/tour-booked', [PhieuHuyController::class, 'cancelTour'])->name('tour.cancelTour');
Route::get('/history/tour-canceled', [HomeController::class, 'tourCanceled'])->name('tour.tour-canceled');
Route::post('/comment/{madanhgia}', [CommentController::class, 'update'])->name('comment.update');
Route::delete('/comment/delete/{madanhgia}', [CommentController::class, 'delete'])->name('comment.delete');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::post('/profile/update', [HomeController::class, 'updateProfile'])->name('profile.update');
Route::get('/tour/{matour}/print', [TourController::class, 'printTour'])->name('tour.print');
Route::get('/dieu-kien-huy-tour', [HomeController::class, 'dieuKienHuyTour'])->name('tour.dieu-kien-huy-tour');
