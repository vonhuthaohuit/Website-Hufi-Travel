<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'mataikhoan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tentaikhoan',
        'email',
        'matkhau',
        'trangthai',
        'manhomquyen',
        'google_id',
    ];

    const PASSWORD_COLUMN = 'matkhau';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'matkhau',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'matkhau' => 'hashed',
    ];

    /* @return string
    */
   public function getAuthPassword()
   {
       return $this->matkhau;  // Chỉ rõ cột mật khẩu là matkhau
   }

    public function nhomquyen(){
        return $this->belongsTo(nhomquyen::class,'manhomquyen','manhomquyen');
    }
    public function khachhang()
    {
        return $this->hasOne(KhachHang::class,'mataikhoan');
    }
    public function nhanVien()
    {
        return $this->hasOne(NhanVien::class, 'mataikhoan', 'mataikhoan');
    }

}
