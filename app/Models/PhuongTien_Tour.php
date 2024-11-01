<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuongTien_Tour extends Model
{
    use HasFactory;
    protected $table = 'phuongtien_tour';
    public function phuongtien(){
        return $this->belongsTo(PhuongTien::class,'phuongtien_id');
    }

    public function tour(){
        return $this->belongsTo(Tour::class,'tour_id');
    }
}
