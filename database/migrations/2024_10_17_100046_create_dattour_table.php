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
        Schema::create('dattour', function (Blueprint $table) {
            $table->integer('tour_id')->unsigned() ;
            $table->integer('khachhang_id')->unsigned() ;
            $table->integer('soluong')->unsigned() ;
            $table->date('ngaydattour') ;
            $table->bigInteger('dongia')->unsigned();
            $table->string('trangthai');
            $table->primary(['tour_id', 'khachhang_id']);
            $table->foreign('khachhang_id')->references('id')->on('tour')->onDelete('cascade');
            $table->foreign('tour_id')->references('id')->on('khachhang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dattour');
    }
};
