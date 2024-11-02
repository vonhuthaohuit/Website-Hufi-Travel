<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiKhachHang extends Model
{
    use HasFactory;
    protected $table = 'loaikhachhang' ;

    public function khachhang()
    {
        return $this->hasMany(KhachHang::class,'maloaikhachhang');
    }
}
