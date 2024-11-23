<?php

namespace App\Http\Controllers\thanhtoan;

use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use App\Models\PhieuDatTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ThanhToanMomoController extends Controller
{
    private $endpoint;
    private $partnerCode;
    private $accessKey;
    private $secretKey;
    private $bankCode;
    public function __construct()
    {
        $this->endpoint = env('MOMO_END_POINT');
        $this->partnerCode = env('MOMO_PARTNER_CODE');
        $this->accessKey = env('MOMO_ACCESS_KEY');
        $this->secretKey = env('MOMO_SECRET_KEY');
        $this->bankCode = env('MOMO_BANK_CODE');
    }
    public function createPayment(Request $request)
    {
        $data = $request->all();
        $maPhieuDatTour = $data['phieudattourid'];
        $phieuDatTour = PhieuDatTour::find($maPhieuDatTour);
        session(['phieuDatTour' => $phieuDatTour]);
        Log::info('Phieu dat tour: ' . session(['phieuDatTour']));
        $amount = $phieuDatTour->tongtienphieudattour;
        $orderId = time() + rand(1, 1000);
        $orderInfo = "Thanh toán qua MoMo";
        $redirectUrl = route('momo.return');
        $ipnUrl = route('momo.return');
        $extraData = "";

        $rawHash = "accessKey=" . $this->accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $this->partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $orderId . "&requestType=captureWallet";
        $signature = hash_hmac("sha256", $rawHash, $this->secretKey);

        $data = [
            'partnerCode' => $this->partnerCode,
            'partnerName' => "MoMo",
            'storeId' => "Test Store",
            'requestId' => $orderId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => 'captureWallet',
            'signature' => $signature
        ];
        $response = Http::post($this->endpoint, $data);
        $responseData = $response->json();
        if (isset($responseData['payUrl'])) {
            return response()->json([
                'status' => 'success',
                'redirect' => $responseData['payUrl'],
            ]);
        }

        return back()->withErrors(['msg' => 'Có lỗi xảy ra khi tạo thanh toán MoMo']);
    }

    public function returnPayment(Request $request)
    {
        Log::info($request->all());

        $orderId = $request->get('orderId');
        $resultCode = $request->get('resultCode');

        $phieuDatTour = session('phieuDatTour');
        $thongTinNguoiDaiDien = session('thongTinNguoiDaiDien');

        if (!$phieuDatTour) {
            Log::error('Phiếu đặt tour không tồn tại trong phiên.');
            return view('frontend/thanhtoan/payment_failed');
        }

        $phuongThucThanhToan = 'Thanh toán online Momo';

        DB::beginTransaction();
        try {
            if ($resultCode == 0) {
                $phieuDatTour->trangthaidattour = 'Đã thanh toán';
                $phieuDatTour->save();

                // Tạo hóa đơn với trạng thái thanh toán
                HoaDon::create([
                    'maphieudattour' => $phieuDatTour->maphieudattour,
                    'tongsotien' => $phieuDatTour->tongtienphieudattour,
                    'phuongthucthanhtoan' => $phuongThucThanhToan,
                    'trangthaithanhtoan' => $phieuDatTour->trangthaidattour,
                    'nguoidaidien' => $thongTinNguoiDaiDien['nguoidaidien'] ?? null,
                    'tendonvi' => $thongTinNguoiDaiDien['tendonvi'] ?? null,
                    'diachidonvi' => $thongTinNguoiDaiDien['diachidonvi'] ?? null,
                    'masothue' => $thongTinNguoiDaiDien['masothue'] ?? null,
                ]);
                DB::commit();
                return view('frontend/thanhtoan/payment_success');
            } else {
                return view('frontend/thanhtoan/payment_failed');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return view('frontend/thanhtoan/payment_failed');
        }
    }
}
