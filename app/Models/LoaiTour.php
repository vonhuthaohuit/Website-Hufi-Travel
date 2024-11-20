<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiTour extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'loaitour';
    protected $primaryKey = 'maloaitour';

    public function tour()
    {
        return $this->hasMany(Tour::class, 'maloaitour');
    }
    public static function layTatCaLoaiTour()
    {
        return LoaiTour::all();
    }
}
