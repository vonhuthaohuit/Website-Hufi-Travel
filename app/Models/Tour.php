<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tour';
    public function dattour(){
        return $this->hasMany(DatTour::class,'tour_id');
    }

    public function khuyenmai(){
        return $this->belongsTo(KhuyenMai::class,'khuyenmai_id');
    }

    public function loaitour(){
        return $this->belongsTo(LoaiTour::class,'loaitour_id');
    }

    public function hinhanhtour(){
        return $this->hasMany(HinhAnhTour::class,'tour_id');
    }

    public function chitiettour(){
        return $this->hasMany(ChiTietTour::class,'tour_id');
    }


    public function chuongtrinhtour(){
        return $this->hasMany(ChuongTrinhTour::class,'tour_id');
    }
}
