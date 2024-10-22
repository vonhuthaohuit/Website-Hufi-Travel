<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietTour extends Model
{
    use HasFactory;
    protected $table = 'chitiettour';


    public function diemdulich(){
        return $this->belongsTo(DiemDuLich::class,'diemdulich_id');
    }
    public function tour(){
        return $this->belongsTo(Tour::class,'tour_id');
    }

}
