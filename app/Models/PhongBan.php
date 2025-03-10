<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhongBan extends Model
{
    use HasFactory;
    protected $table = 'phongban';
    protected $primaryKey = 'maphongban';

    public function nhanvien()
    {
        return $this->hasMany(NhanVien::class, 'maphongban');
    }
    public function truongphong()
    {
        return $this->belongsTo(NhanVien::class, 'truongphong', 'manhanvien');
    }
}
