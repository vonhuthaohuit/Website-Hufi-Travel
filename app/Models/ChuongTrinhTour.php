<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChuongTrinhTour extends Model
{
    use HasFactory;
    protected $table = 'chuongtrinhtour';
    public function tour(){
        return $this->belongsTo(Tour::class,'tour_id');
    }

    public function phancongnhanvien(){
        return $this->hasMany(PhanCongNhanVien::class,'chuongtrinhtour_id');
    }
}
