<?php

namespace App\Http\Controllers\thanhtoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $orderId = time() + rand(1, 1000);
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $request['amount'];
        $amount = str_replace(',', '', $amount);
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
        dd($request->all());
        $orderId = $request->get('orderId');
        $resultCode = $request->get('resultCode');

        if ($resultCode == 0) {
            return view('frontend/thanhtoan/payment_success');
        } else {
            return view('frontend/thanhtoan/payment_failed');
        }
    }
}
