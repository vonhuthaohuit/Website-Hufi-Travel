<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuongTien_Tour extends Model
{
    use HasFactory;
    protected $table = 'phuongtien_tour';
    public $timestamps = false;

    public function phuongtien(){
        return $this->belongsTo(PhuongTien::class,'maphuongtien','maphuongtien');
    }

    public function tour(){
        return $this->belongsTo(Tour::class,'matour','matour');
    }
}
