<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;
    protected $table = 'hoadon';
    public $timestamps = false;

    protected $primaryKey = 'mahoadon';
    protected $fillable = [
        'makhachhang',
        'maphieudattour',
        'tongsotien',
        'phuongthucthanhtoan',
        'trangthaithanhtoan',
        'nguoidaidien',
        'tendonvi',
        'diachidonvi',
        'masothue',
    ];

    public function phieudattour()
    {
        return $this->belongsTo(PhieuDatTour::class, 'maphieudattour', 'maphieudattour');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'matour', 'matour');
    }
}
