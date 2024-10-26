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
            $table->increments('id');
            $table->string('noidung');
            $table->integer('diemdanhgia')->unsigned();
            $table->integer('khachhang_id')->unsigned() ;
            $table->foreign('khachhang_id')->references('id')->on('khachhang')->onDelete('cascade');
            $table->timestamp('ngaydanhgia')->nullable();
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
