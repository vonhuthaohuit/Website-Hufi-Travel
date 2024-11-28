<?php

namespace App\Http\Controllers\backend;

use App\DataTables\PhieuHuyDatatables;
use App\Http\Controllers\Controller;
use App\Models\PhieuHuyTour;
use Illuminate\Http\Request;

class PhieuHuyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PhieuHuyDatatables $dataTable)
    {
        return $dataTable->render('backend.hoadon.phieuhuy.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($maphieuhuytour)
    {
        PhieuHuyTour::find($maphieuhuytour)->delete();
        return response(['status' => 'success', 'message' => 'Xóa phiếu hủy thành công']);
    }
}
