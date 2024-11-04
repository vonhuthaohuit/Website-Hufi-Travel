<?php

namespace App\Http\Controllers\thanhtoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ThanhToanMomoController extends Controller
{
    private $endpoint = 'https://test-payment.momo.vn/v2/gateway/api/create';
    private $partnerCode = 'YOUR_PARTNER_CODE';
    private $accessKey = 'YOUR_ACCESS_KEY';
    private $secretKey = 'YOUR_SECRET_KEY';

    public function createPayment(Request $request)
    {
        $orderId = time();
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $request->get('tong-tien-thanh-toan');
        $redirectUrl = route('payment.momo.callback');
        $ipnUrl = route('payment.momo.callback');
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

        if ($response->successful() && isset($response['payUrl'])) {
            return redirect($response['payUrl']);
        }

        return back()->withErrors(['msg' => 'Có lỗi xảy ra khi tạo thanh toán MoMo']);
    }

    public function callback(Request $request)
    {
        $orderId = $request->get('orderId');
        $resultCode = $request->get('resultCode');

        if ($resultCode == 0) {
            return redirect()->route('home')->with('success', 'Thanh toán thành công!');
        } else {
            return redirect()->route('home')->withErrors('Thanh toán thất bại!');
        }
    }
}
