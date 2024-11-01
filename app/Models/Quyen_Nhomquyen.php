<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quyen_Nhomquyen extends Model
{
    use HasFactory;
    protected $table = 'quyen_nhomquyen';
    public function quyen(){
        return $this->belongsTo(Quyen::class,'phuongtien_id');
    }

    public function tour(){
        return $this->belongsTo(NhomQuyen::class,'tour_id');
    }
}
