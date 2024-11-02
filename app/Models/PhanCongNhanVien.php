<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanCongNhanVien extends Model
{
    use HasFactory;
    protected $table = 'phancongnhanvien';

    public function tour(){
        return $this->belongsTo(Tour::class,'matour','matour');
    }

    public function nhanvien(){
        return $this->belongsTo(nhanvien::class,'manhanvien','manhanvien');
    }
}
