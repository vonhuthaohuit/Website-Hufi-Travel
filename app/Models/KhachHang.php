<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class KhachHang extends Model
{
    use HasFactory;
    protected $table = 'khachhang';
    public function diachi(){
        return $this->hasMany(DiaChi::class,'khachhang_id');
    }

    public function dattour(){
        return $this->hasMany(DatTour::class,'khachhang_id');
    }


    public function danhgia(){
        return $this->hasMany(danhgia::class,'khachhang_id');
    }

    public function hoadon(){
        return $this->hasMany(HoaDon::class,'khachhang_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
