<?php

namespace App\Http\Controllers\thanhtoan;

use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use App\Models\PhieuDatTour;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ThanhToanVNPayController extends Controller
{

    public function createPayment(Request $request)
    {
        $data = $request->all();
        $maPhieuDatTour = $data['phieudattourid'];
        $phieuDatTour = PhieuDatTour::find($maPhieuDatTour);
        session(['phieuDatTour' => $phieuDatTour]);
        Log::info('Phieu dat tour: ' . session(['phieuDatTour']));
        $amount = $phieuDatTour->tongtienphieudattour;
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.returnPayment');
        $vnp_TmnCode = env('VNP_TMN_CODE');
        $vnp_HashSecret = env('VNP_HASH_SECRET');
        $vnp_TxnRef = rand(1, 1000000);
        $vnp_OrderInfo = 'Thanh toán hóa đơn đặt tour';
        $vnp_OrderType = 'Hufi Travel';
        $vnp_Amount = $amount * 100;
        $vnp_Locale = 'VM';
        $vnp_BankCode = 'VNPAY';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return response()->json([
            'status' => 'success',
            'redirect' => $vnp_Url,
        ]);
    }

    public function returnPayment(Request $request)
    {
        $vnp_HashSecret = env('VNP_HASH_SECRET');
        $vnp_SecureHash = $request->vnp_SecureHash;

        $inputData = Arr::except($request->all(), ['vnp_SecureHash']);
        ksort($inputData);

        $hashData = http_build_query($inputData, '', '&');
        $generatedSecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        Log::info('Chữ ký bảo mật: ' . $generatedSecureHash);
        Log::info('Chữ ký bảo mật nhận được: ' . $vnp_SecureHash);
        if ($generatedSecureHash !== $vnp_SecureHash) {
            Log::error('Chữ ký bảo mật không hợp lệ.');
            return view('frontend/thanhtoan/payment_failed');
        }

        $phieuDatTour = session('phieuDatTour');
        $thongTinNguoiDaiDien = session('thongTinNguoiDaiDien');

        if (!$phieuDatTour) {
            Log::error('Phiếu đặt tour không tồn tại trong phiên.');
            return view('frontend/thanhtoan/payment_failed');
        }

        $phuongThucThanhToan = 'Thanh toán online VNPay';
        $trangThaiThanhToan = $request->vnp_ResponseCode == '00' ? 'Đã thanh toán' : 'Thanh toán thất bại';

        DB::beginTransaction();
        try {
            if ($trangThaiThanhToan === 'Đã thanh toán') {
                $phieuDatTour->trangthaidattour = 'Đã thanh toán';
                $phieuDatTour->save();
            }
            $user = Session::get('user');
            $maTaiKhoan = $user['mataikhoan'];
            $khachHang = DB::where('mataikhoan', $maTaiKhoan)->first();
            // Tạo hóa đơn với trạng thái thanh toán
            HoaDon::create([
                'mataikhoan' => $khachHang ->mataikhoan,
                'maphieudattour' => $phieuDatTour->maphieudattour,
                'tongsotien' => $phieuDatTour->tongtienphieudattour,
                'phuongthucthanhtoan' => $phuongThucThanhToan,
                'trangthaithanhtoan' => $trangThaiThanhToan,
                'nguoidaidien' => $thongTinNguoiDaiDien['nguoidaidien'] ?? null,
                'tendonvi' => $thongTinNguoiDaiDien['tendonvi'] ?? null,
                'diachidonvi' => $thongTinNguoiDaiDien['diachidonvi'] ?? null,
                'masothue' => $thongTinNguoiDaiDien['masothue'] ?? null,
            ]);

            DB::commit();

            return view($trangThaiThanhToan === 'Đã thanh toán'
                ? 'frontend/thanhtoan/payment_success'
                : 'frontend/thanhtoan/payment_failed');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Lỗi trong quá trình lưu hóa đơn: " . $e->getMessage(), [
                'phieuDatTour' => $phieuDatTour->maphieudattour ?? null,
                'trangThaiThanhToan' => $trangThaiThanhToan
            ]);
            return view('frontend/thanhtoan/payment_failed');
        }
    }
}
