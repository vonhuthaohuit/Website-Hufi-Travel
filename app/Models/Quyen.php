<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    use HasFactory;
    protected $table = 'quyen';
    protected $primaryKey = 'maquyen';
    public function quyen_nhomquyen(){
        return $this->hasMany(Quyen_Nhomquyen::class,'maquyen');
    }
}
