<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiemDuLich extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'diemdulich';
    public function chitiettour(){
        return $this->hasMany(ChiTietTour::class,'madiemdulich');
    }
    public static function layTatCaDiemDuLich(){
        return DiemDuLich::all();
    }
}
