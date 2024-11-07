<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HinhAnhTour extends Model
{
    use HasFactory;
    protected $table = 'hinhanhtour';
    protected $primaryKey = 'mahinhanhtour';


    public function tour(){
        return $this->belongsTo(Tour::class,'matour','matour');
    }
}
