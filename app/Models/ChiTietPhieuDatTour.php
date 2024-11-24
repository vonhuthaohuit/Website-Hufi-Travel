<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietPhieuDatTour extends Model
{
    protected $table = 'chitietphieudattour';
    protected $primaryKey = 'maphieudattour';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'makhachhang',
        'maphieudattour',
        'chitietsotiendat',
        'nguoidat'
    ];
    public function phieudattour()
    {
        return $this->belongsTo(PhieuDatTour::class, 'maphieudattour', 'maphieudattour');
    }
    public function khachhang()
    {
        return $this->belongsTo(KhachHang::class, 'makhachhang', 'makhachhang');
    }
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'matour', 'matour');
    }
}
