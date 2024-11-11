<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChuongTrinhTour extends Model
{
    use HasFactory;
    protected $table = 'chuongtrinhtour';
    protected $primaryKey = 'machuongtrinhtour';

    public function tour(){
        return $this->belongsTo(Tour::class,'matour','matour');
    }


}
