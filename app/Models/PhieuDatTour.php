<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuDatTour extends Model
{
    use HasFactory;
    protected $table = 'phieudattour';
    protected $primaryKey = 'maphieudattour';
    public $timestamps = false;
    protected $fillable = [
        'maphieudattour',
        'ngaydattour',
        'ngaykhoihanh',
        'tongtienphieudattour',
        'tongsoluong',
        'trangthaidattour',
        'matour'
    ];
    public function chitietphieudattour()
    {
        return $this->hasMany(ChiTietPhieuDatTour::class, 'maphieudattour');
    }
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'matour', 'matour');
    }
}
