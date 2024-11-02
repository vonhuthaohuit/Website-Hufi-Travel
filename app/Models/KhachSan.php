<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachSan extends Model
{
    use HasFactory;
    protected $table = 'khachsan';

    public function khachsan_chuongtrinh(){
        return $this->hasMany(KhachSan_Tour::class,'makhachsan');
    }
}
