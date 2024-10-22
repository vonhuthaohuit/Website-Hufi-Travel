<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;
    protected $table = 'nhanvien';

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function phongban(){
        return $this->belongsTo(PhongBan::class,'phongban_id');
    }

    public function phancongchucvu(){
        return $this->hasMany(PhanCongChucVu::class,'nhanvien_id');
    }
    
    public function blogtour(){
        return $this->hasMany(BlogTour::class,'nhanvien_id');
    }

    public function phancongnhanvien(){
        return $this->hasMany(PhanCongNhanVien::class,'nhanvien_id');
    }
    
}
