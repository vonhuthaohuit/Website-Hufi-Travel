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
            $table->increments('mahoadon');
            $table->float('tongsotien')->unsigned();
            $table->string('trangthaithanhtoan') ;
            $table->string('phuongthucthanhtoan') ;
            $table->string('masothue');
            $table->string('tendonvi') ;
            $table->string('diachidonvi') ;
            $table->integer('maphieuhuytour')->unsigned()->nullable();
            $table->integer('maphieudattour')->unsigned();
            $table->integer('makhachhang')->unsigned();
            $table->foreign('makhachhang')->references('makhachhang')->on('khachhang')->onDelete('cascade');
            $table->foreign('maphieudattour')->references('maphieudattour')->on('phieudattour')->onDelete('cascade');
            $table->foreign('maphieuhuytour')->references('maphieuhuytour')->on('phieuhuytour')->onDelete('cascade');
            $table->timestamps();
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
