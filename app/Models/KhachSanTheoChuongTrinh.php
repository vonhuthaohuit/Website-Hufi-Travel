<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachSanTheoChuongTrinh extends Model
{
    use HasFactory;
    protected $table = 'khachsantheochuongtrinh';

    public function khachsan(){
        return $this->belongsTo(KhachSan::class,'khachsan_id');
    }

    public function chuongtrinhtour(){
        return $this->belongsTo(ChuongTrinhTour::class,'chuongtrinhtour_id');
    }

    
}
