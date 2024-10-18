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
            $table->increments('id');
            $table->string('hoten');
            $table->string('gioitinh');
            $table->date('ngaysinh');
            $table->string('sodienthoai');
            $table->string('email');
            $table->string('bangcap');
            $table->string('hinhdaidien');
            $table->bigInteger('luong');
            $table->date('ngayvaolam') ;
            $table->integer('phongban_id')->unsigned();
            $table->foreign('phongban_id')->references('id')->on('phongban');
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
