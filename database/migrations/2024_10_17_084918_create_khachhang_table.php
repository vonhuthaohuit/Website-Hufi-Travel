<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('khachhang', function (Blueprint $table) {
            $table->increments('makhachhang');
            $table->string('hoten');
            $table->string('gioitinh');
            $table->date('ngaysinh');
            $table->string('diachi') ;
            $table->string('sodienthoai');
            $table->string('hinhdaidien');
            $table->integer('maloaikhachhang')->unsigned() ;
            $table->foreign('maloaikhachhang')->references('maloaikhachhang')->on('loaikhachhang')->onDelete('cascade');
            $table->integer('mataikhoan')->unsigned() ;
            $table->foreign('mataikhoan')->references('mataikhoan')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khachhang');
    }
};
