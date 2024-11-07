<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'makhuyenmai';
    protected $table = 'khuyenmai';
    protected $primaryKey = 'makhuyenmai';

    public function tour(){
        return $this->hasMany(Tour::class,'makhuyenmai');
    }
}
