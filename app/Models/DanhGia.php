<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;
    protected $table = 'danhgia';
    public function khachhang(){
        return $this->belongsTo(KhachSanTheoChuongTrinh::class,'khachhang_id');
    }
}