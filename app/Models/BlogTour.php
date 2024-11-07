<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTour extends Model
{
    use HasFactory;
    protected $primaryKey = 'mablogtour';
    protected $table = 'blogtour';
    protected $primaryKey = 'mablogtour';

    public function loaiblog(){
        return $this->belongsTo(LoaiBlog::class,'maloaiblog','maloaiblog');
    }
    public function nhanvien(){
        return $this->belongsTo(nhanvien::class,'manhanvien','manhanvien');
    }



}
