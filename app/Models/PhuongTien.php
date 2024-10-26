<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuongTien extends Model
{
    use HasFactory;
    protected $table = 'phuongtien';
    public function phuongtientheochuongtrinh(){
        return $this->hasMany(PhuongTienTheoChuongTrinh::class,'phuongtien_id');
    }
}
