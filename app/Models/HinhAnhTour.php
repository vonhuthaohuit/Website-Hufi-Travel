<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HinhAnhTour extends Model
{
    use HasFactory;
    protected $table = 'hinhanhtour';

    public function tour(){
        return $this->belongsTo(Tour::class,'tour_id'); 
    }
}
