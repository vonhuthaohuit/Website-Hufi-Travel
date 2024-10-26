<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanCongChucVu extends Model
{
    use HasFactory;
    protected $table = 'phancongcongviec';

    public function chucvu(){
        return $this->belongsTo(ChucVu::class,'chucvu_id');
    }
}
