<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiTour extends Model
{
    use HasFactory;
    protected $table = 'loaitour';

    public function tour(){
        return $this->hasMany(Tour::class,'loaitour_id');
    }

}
