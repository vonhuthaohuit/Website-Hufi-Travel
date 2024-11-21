<?php

namespace App\Http\Controllers\thanhtoan;

use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\LoaiKhachHang;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HoaDonController extends Controller
{
    protected $hoaDon;
    public function __construct()
    {
        $this->hoaDon = new HoaDon();
    }
    public function index()
    {
        if (Session::get("user") == null) {
            return redirect()->route('login');
        }
        $hoaDons = $this->hoaDon->paginate(5);
        return view("frontend.thanhtoan.hoadon", compact('hoaDons'));
    }

    public function TaoHoaDon($phieuDatTour, $thongTinNguoiDatTour, $tongSoTien, $phuongThucThanhToan, $trangThaiThanhToan)
    {
        HoaDon::create([
            'phieuDatTour' => $phieuDatTour,
            'tongsotien' => $tongSoTien,
            'phuongthucthanhtoan' => $phuongThucThanhToan,
            'trangthaithanhtoan' => $trangThaiThanhToan,
            'nguoidaidien' => $thongTinNguoiDatTour->nguoiDaiDien ?? null,
            'tendonvi' => $thongTinNguoiDatTour->tendonvi ?? null,
            'diachidonvi' => $thongTinNguoiDatTour->diachi ?? null,
            'masothue' => $thongTinNguoiDatTour->maSoThue ?? null,
        ]);
    }
    public function XoaHoaDon($id)
    {
        $hoaDon = HoaDon::find($id);

        if ($hoaDon) {
            $hoaDon->delete();
            return response()->json(['message' => 'Hóa đơn đã được xoá thành công.']);
        } else {
            return response()->json(['message' => 'Không tìm thấy hóa đơn.'], 404);
        }
    }
    public function SuaHoaDon(Request $request, $id)
    {
        $hoaDon = HoaDon::find($id);

        if ($hoaDon) {
            $hoaDon->update([
                'phieuDatTour' => $request->phieuDatTour ?? $hoaDon->phieuDatTour,
                'tongsotien' => $request->tongSoTien ?? $hoaDon->tongsotien,
                'phuongthucthanhtoan' => $request->phuongThucThanhToan ?? $hoaDon->phuongthucthanhtoan,
                'trangthaithanhtoan' => $request->trangThaiThanhToan ?? $hoaDon->trangthaithanhtoan,
                'nguoidaidien' => $request->nguoiDaiDien ?? $hoaDon->nguoidaidien,
                'tendonvi' => $request->tenDonVi ?? $hoaDon->tendonvi,
                'diachidonvi' => $request->diaChiDonVi ?? $hoaDon->diachidonvi,
                'masothue' => $request->maSoThue ?? $hoaDon->masothue,
            ]);

            return response()->json(['message' => 'Hóa đơn đã được cập nhật thành công.']);
        } else {
            return response()->json(['message' => 'Không tìm thấy hóa đơn.'], 404);
        }
    }
    public function TimKiemHoaDon(Request $request)
    {
        $query = HoaDon::query();

        if ($request->has('phieuDatTour')) {
            $query->where('phieuDatTour', $request->phieuDatTour);
        }

        if ($request->has('trangThaiThanhToan')) {
            $query->where('trangthaithanhtoan', $request->trangThaiThanhToan);
        }

        $hoaDons = $query->get();

        return response()->json($hoaDons);
    }
    public function create()
    {
        $tours = Tour::all();
        $loaikhachs = LoaiKhachHang::all();


        return view('frontend.thanhtoan.taohoadon', compact('tours'));
    }

    public function store(Request $request)
    {
        // Xử lý lưu dữ liệu vào cơ sở dữ liệu
        $validatedData = $request->validate([
            'ticket_fullname' => 'required|string|max:255',
            'ticket_address' => 'required|string|max:255',
            'ticket_phone' => 'required|string|max:20',
            'ticket_email' => 'required|email',
            'ticket_note' => 'nullable|string',
            // Validate customer data
        ]);

        // Logic lưu hóa đơn và khách hàng
        $hoadon = new HoaDon();
        $hoadon->tour_id = $request->tourId;
        $hoadon->fullname = $request->ticket_fullname;
        $hoadon->address = $request->ticket_address;
        $hoadon->phone = $request->ticket_phone;
        $hoadon->email = $request->ticket_email;
        $hoadon->note = $request->ticket_note;
        $hoadon->save();

        foreach ($request->td_ticket as $customer) {
            $khachHang = new KhachHang();
            $khachHang->hoadon_id = $hoadon->id;
            $khachHang->name = $customer['td_name'];
            $khachHang->birthday = $customer['td_birthday'];
            $khachHang->gender = $customer['td_gender'];
            $khachHang->loaikhach_id = $customer['td_loaikhach'];
            $khachHang->price = $customer['td_price'];
            $khachHang->save();
        }

        return redirect()->route('hoadon.index')->with('success', 'Hóa đơn đã được tạo thành công');
    }


    public function edit(HoaDon $hoadon)
    {
        return view('frontend.thanhtoan.suahoadon', compact('hoadon'));
    }

    public function update(Request $request, HoaDon $hoadon)
    {
        $request->validate([
            'maphieudattour' => 'required',
            'tongsotien' => 'required|numeric',
            'phuongthucthanhtoan' => 'required',
        ]);

        $hoadon->update($request->all());

        return redirect()->route('hoadon.index')->with('success', 'Hóa đơn được cập nhật thành công!');
    }

    public function destroy(HoaDon $hoadon)
    {
        $hoadon->delete();

        return redirect()->route('hoadon.index')->with('success', 'Hóa đơn được xóa thành công!');
    }
}
