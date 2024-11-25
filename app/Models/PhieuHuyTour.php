<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuHuyTour extends Model
{
    use HasFactory;
    protected $table = 'phieuhuytour';
    protected $primaryKey = 'maphieuhuytour';
    public $timestamps = false;

    // public function hoadon(){
    //     return $this->belongsTo(HoaDon::class,'mahoadon',);
    // }

}
