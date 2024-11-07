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
        Schema::create('tour', function (Blueprint $table) {
            $table->increments('matour');
            $table->string('tentour');
            $table->text('motatour');
            $table->boolean('tinhtrang');
            $table->string('hinhdaidien');
            $table->string('noikhoihanh');
            $table->string('thoigiandi');
            $table->bigInteger('giatour');
            $table->integer('maloaitour')->unsigned();
            $table->foreign('maloaitour')->references('maloaitour')->on('loaitour')->onDelete('cascade');
            $table->integer('makhuyenmai')->unsigned()->nullable();
            $table->foreign('makhuyenmai')->references('makhuyenmai')->on('khuyenmai')->onDelete('cascade');
            $table->timestamps();
            //'ngaytao'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour');
    }
};
