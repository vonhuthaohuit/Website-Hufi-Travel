<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanCongChucVu extends Model
{
    use HasFactory;
    protected $table = 'phancongchucvu';

    public function chucvu(){
        return $this->belongsTo(ChucVu::class,'machucvu','machucvu');
    }

    public function nhanvien(){
        return $this->belongsTo(NhanVien::class,'manhanvien','manhanvien');
    }
}
