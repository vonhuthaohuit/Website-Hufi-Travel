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
        Schema::create('nhanvien', function (Blueprint $table) {
            $table->increments('manhanvien');
            $table->string('hoten');
            $table->string('gioitinh');
            $table->date('ngaysinh');
            $table->string('sodienthoai');
            $table->string('bangcap');
            $table->string('hinhdaidien');
            $table->float('luong');
            $table->date('ngayvaolam') ;
            $table->integer('maphongban')->unsigned();
            $table->foreign('maphongban')->references('maphongban')->on('phongban')->onDelete('cascade');
            $table->integer('mataikhoan')->unsigned() ;
            $table->foreign('mataikhoan')->references('mataikhoan')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhanvien');
    }
};
