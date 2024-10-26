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
        Schema::create('hoadon', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('tongsotien')->unsigned();
            $table->string('trangthai') ;
            $table->string('phuongthucthanhtoan');  
            $table->integer('khachhang_id')->unsigned();
            $table->foreign('khachhang_id')->references('id')->on('khachhang')->onDelete('cascade');
            $table->timestamp('ngaytao')->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoadon');
    }
};
