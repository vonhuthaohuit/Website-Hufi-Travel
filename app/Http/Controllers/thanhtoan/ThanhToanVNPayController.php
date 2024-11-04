<?php

namespace App\Http\Controllers\thanhtoan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ThanhToanVNPayController extends Controller
{
    public function createPayment(Request $request)
    {
        Log::info('Create payment', $request->all());
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.returnPayment');
        $vnp_TmnCode = env('VNP_TMN_CODE');
        $vnp_HashSecret = env('VNP_HASH_SECRET');
        $vnp_TxnRef = rand(1, 1000000);
        $vnp_OrderInfo = 'Thanh toán hóa đơn';
        $vnp_OrderType = 'Hufi Travel';
        $vnp_Amount = 20000 * 100; //$request->total_amount * 100;
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
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            Log::info('Create payment secure hash', ['secure_hash' => $vnp_Url]);
        }
        Log::info('Create payment response', $inputData);
        return response()->json([
            'status' => 'success',
            'redirect' => $vnp_Url,
        ]);
    }

    public function returnPayment(Request $request)
    {
        $vnp_HashSecret = env('VNP_HASH_SECRET');
        $vnp_SecureHash = $request->vnp_SecureHash;

        $inputData = $request->except('vnp_SecureHash');
        ksort($inputData);
        $hashData = '';
        foreach ($inputData as $key => $value) {
            $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
        }
        $generatedSecureHash = hash_hmac('sha512', ltrim($hashData, '&'), $vnp_HashSecret);
        if ($generatedSecureHash === $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                try {
                    return view('frontend/thanhtoan/payment_success');
                } catch (\Exception $e) {
                    return view('frontend/thanhtoan/payment_failed');
                }
            } elseif ($request->vnp_ResponseCode == '10') {
                return view('frontend/thanhtoan/payment_failed');
            } elseif ($request->vnp_ResponseCode == '11') {
                return view('frontend/thanhtoan/payment_failed');
            } elseif ($request->vnp_ResponseCode == '12') {
                return view('frontend/thanhtoan/payment_failed');
            } elseif ($request->vnp_ResponseCode == '13') {
                return view('frontend/thanhtoan/payment_failed');
            } elseif ($request->vnp_ResponseCode == '24') {
                return view('frontend/thanhtoan/payment_failed');
            } else {
                return view('frontend/thanhtoan/payment_failed');
            }
        } else {
            return view('frontend/thanhtoan/payment_failed');
        }
    }
}
