<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuongTien extends Model
{
    use HasFactory;
    protected $table = 'phuongtien';
    protected $primaryKey = 'maphuongtien';

    public function phuongtientheochuongtrinh(){
        return $this->hasMany(PhuongTien_Tour::class,'maphuongtien');
    }
}
