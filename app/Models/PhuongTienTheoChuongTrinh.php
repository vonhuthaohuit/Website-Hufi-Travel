<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuongTienTheoChuongTrinh extends Model
{
    use HasFactory;
    protected $table = 'phuongtientheochuongtrinh';
    public function phuongtien(){
        return $this->belongsTo(PhuongTien::class,'phuongtien_id');
    }

    public function chuongtrinhtour(){
        return $this->belongsTo(ChuongTrinhTour::class,'chuongtrinh_id');
    }
}
