<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;
    protected $table = 'nhanvien';
    public function blogtour(){
        return $this->hasMany(BlogTour::class,'manhanvien');
    }
    public function user(){
        return $this->belongsTo(User::class,'mataikhoan','mataikhoanaaa');
    }

    public function phongban(){
        return $this->belongsTo(PhongBan::class,'maphongban','maphongban');
    }

    public function phancongchucvu(){
        return $this->hasMany(PhanCongChucVu::class,'manhanvien');
    }



    public function phancongnhanvien(){
        return $this->hasMany(PhanCongNhanVien::class,'manhanvien');
    }

}
