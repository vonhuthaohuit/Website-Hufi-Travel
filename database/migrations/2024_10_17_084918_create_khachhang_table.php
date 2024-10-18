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
            $table->increments('id');
            $table->string('hoten');
            $table->string('gioitinh');
            $table->date('ngaysinh');
            $table->string('sodienthoai');
            $table->string('email');
            $table->string('hinhdaidien');
            $table->integer('user_id')->unsigned() ;
            $table->foreign('user_id')->references('id')->on('users');
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
