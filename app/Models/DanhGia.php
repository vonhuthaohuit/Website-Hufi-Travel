<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;
    protected $table = 'danhgia';
    protected $primaryKey = 'madanhgia';

    public function khachhang(){
        return $this->belongsTo(KhachHang::class,'makhachhang','makhachhang');
    }
}
