<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietPhieuDatTour extends Model
{
    protected $table = 'chitietphieudattour';

    use HasFactory;

    public function phieudattour(){
        return $this->belongsTo(PhieuDatTour::class,'maphieudattour','maphieudattour');
    }
    public function khachhang(){
        return $this->belongsTo(KhachHang::class,'makhachhang','makhachhang');
    }

}
