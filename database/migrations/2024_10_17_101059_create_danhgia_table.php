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
        Schema::create('danhgia', function (Blueprint $table) {
            $table->increments('madanhgia');
            $table->string('noidung');
            $table->integer('diemdanhgia')->unsigned();
            $table->integer('makhachhang')->unsigned() ;
            $table->foreign('makhachhang')->references('makhachhang')->on('khachhang')->onDelete('cascade');
            $table->timestamps() ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danhgia');
    }
};
