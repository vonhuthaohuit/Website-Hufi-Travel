<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class KhachHang extends Model
{
    use HasFactory;
    protected $table = 'khachhang';
    protected $primaryKey = 'makhachhang';
    public $timestamps = false;
    protected $fillable = [
        'hoten',
        'gioitinh',
        'ngaysinh',
        'maloaikhachhang',
    ];

    public function user(){
        return $this->belongsTo(User::class,'mataikhoan','matikhoan');
    }

    public function chitietphieudattour(){
        return $this->hasMany(ChiTietPhieuDatTour::class,'makhachhang');
    }


    public function danhgia(){
        return $this->hasMany(danhgia::class,'makhachhang');
    }

    public function loaikhachhang(){
        return $this->belongsTo(LoaiKhachHang::class,'maloaikhachhang','maloaikhachhang');
    }


}
