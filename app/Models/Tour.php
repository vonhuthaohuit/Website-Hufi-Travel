<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tour extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tour';
    protected $primaryKey = 'matour';
    public function dattour()
    {
        return $this->hasMany(PhieuDatTour::class, 'matour');
    }

    public function khuyenmai()
    {
        return $this->belongsTo(KhuyenMai::class, 'makhuyenmai', 'makhuyenmai');
    }

    public function loaitour()
    {
        return $this->belongsTo(LoaiTour::class, 'maloaitour', 'maloaitour');
    }

    public function hinhanhtour()
    {
        return $this->hasMany(HinhAnhTour::class, 'matour');
    }

    public function chitiettour()
    {
        return $this->hasMany(ChiTietTour::class, 'matour');
    }


    public function chuongtrinhtour()
    {
        return $this->hasMany(ChuongTrinhTour::class, 'matour');
    }


    public function khachsan_tour()
    {
        return $this->hasMany(KhachSan_Tour::class, 'matour');
    }
    public function chitietkhachsantour()
    {
        return $this->hasMany(KhachSan_Tour::class, 'matour', 'matour');
    }
    public function chitietphuongtientour()
    {
        return $this->hasMany(PhuongTien_Tour::class, 'matour', 'matour');
    }
    public function phuongtien_tour()
    {
        return $this->hasMany(PhuongTien_Tour::class, 'matour');
    }
    public static function layTatCaNoiKhoiHanh()
    {
        return Tour::select('noikhoihanh')->distinct()->get();
    }
    public function danhgia_tour()
    {
        return $this->hasMany(DanhGia::class, 'matour');
    }
}
