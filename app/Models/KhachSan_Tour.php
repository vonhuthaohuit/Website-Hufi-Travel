<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachSan_Tour extends Model
{
    use HasFactory;
        protected $table = 'khachsan_tour';

        public function khachsan(){
            return $this->belongsTo(KhachSan::class,'makhachsan','makhachsan');
        }

    public function tour(){
        return $this->belongsTo(Tour::class,'matour','matour');
    }


}
