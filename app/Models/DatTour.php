<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatTour extends Model
{
    use HasFactory;
    protected $table = 'dattour';

    public function tour(){
        return $this->belongsTo(Tour::class,'tour_id');
    }

    public function khachhang(){
        return $this->belongsTo(KhachHang::class,'khachhang_id');
    }
}
