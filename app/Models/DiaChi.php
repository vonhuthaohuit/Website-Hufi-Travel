<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaChi extends Model
{
    use HasFactory;
    protected $table = 'diachi';
    public function khachhang(){
        return $this->belongsTo(KhachHang::class,'khachhang_id');
    }
}
