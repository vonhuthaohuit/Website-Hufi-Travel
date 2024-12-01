<?php

namespace App\Mail;

use App\Models\HoaDon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ThanhToanThanhCong extends Mailable
{
    use Queueable, SerializesModels;

    public $hoadon;
    public $sodienthoai;
    public $nguoidat;

    public function __construct($hoadon)
    {
        $this->hoadon = HoaDon::with([
            'phieudattour.tour',
            'phieudattour.chitietphieudattour',
            'phieudattour.chitietphieudattour.khachhang'
        ])->findOrFail($hoadon->mahoadon);
        $maKhachHang = $hoadon->phieudattour->chitietphieudattour->first()->nguoidat;
        Log::info('phieudattour: ' . $hoadon->phieudattour);
        $this->sodienthoai = 'N/A';
        foreach ($hoadon->phieudattour->chitietphieudattour as $chiTiet) {
            if ($chiTiet->nguoidat == $maKhachHang) {
                $this->sodienthoai = $chiTiet->khachhang->sodienthoai;
                break;
            }
        }
    }

    public function build()
    {
        return $this->subject('Xác nhận đặt tour thành công')
            ->view('frontend.mail.thanhtoanthanhcong')
            ->with([
                'hoadon' => $this->hoadon,
                'sodienthoai' => $this->sodienthoai,
            ]);
    }
}
