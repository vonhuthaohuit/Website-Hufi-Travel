<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachSan_Tour extends Model
{
    use HasFactory;
    protected $table = 'khachsan_tour';

    public function khachsan(){
        return $this->belongsTo(KhachSan::class,'khachsan_id');
    }

    public function tour(){
        return $this->belongsTo(Tour::class,'tour_id');
    }


}
