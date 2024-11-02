<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quyen_Nhomquyen extends Model
{
    use HasFactory;
    protected $table = 'quyen_nhomquyen';
    public function quyen(){
        return $this->belongsTo(Quyen::class,'maquyen','maquyen');
    }

    public function nhomquyen(){
        return $this->belongsTo(NhomQuyen::class,'manhomquyen','manhomquyen');
    }
}
