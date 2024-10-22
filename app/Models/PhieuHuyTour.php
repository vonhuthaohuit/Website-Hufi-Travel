<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuHuyTour extends Model
{
    use HasFactory;
    protected $table = 'phieuhuytour';
    public function hoadon(){
        return $this->belongsTo(HoaDon::class,'hoadon_id');
    }

}
