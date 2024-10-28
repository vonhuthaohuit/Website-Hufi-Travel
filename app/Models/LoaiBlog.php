<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiBlog extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'loaiblog';

    public function blogtour()
    {
        return $this->hasMany(BlogTour::class, 'loaiblog_id');
    }
}
