<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getProvinces()
    {
        $filePath = asset('frontend/library/hanhchinhvn/dist/tinh_tp.json');


        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);

        return response()->json($data);
    }

    public function getDistricts($provinceId)
    {
        $filePath = asset('frontend/library/hanhchinhvn/dist/quan_huyen.json');

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);

        $districts = array_filter($data, function ($item) use ($provinceId) {
            return $item['parent_code'] == $provinceId;
        });

        return response()->json(array_values($districts));
    }

    public function getWards($districtId)
    {
        $filePath = asset('frontend/library/hanhchinhvn/dist/xa_phuong.json');

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);

        $wards = array_filter($data, function ($item) use ($districtId) {
            return $item['parent_code'] == $districtId;
        });

        return response()->json(array_values($wards));
    }
}
