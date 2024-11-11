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
        Schema::create('chitietphuongtientour', function (Blueprint $table) {
            $table->integer('matour')->unsigned();
            $table->integer('maphuongtien')->unsigned();
            $table->integer('soluonghanhkhach')->unsigned();
            $table->string('ghichu') ;
            $table->primary(['matour', 'maphuongtien']);
            $table->foreign('matour')->references('matour')->on('tour')->onDelete('cascade');
            $table->foreign('maphuongtien')->references('maphuongtien')->on('phuongtien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietphuongtientour');
    }
};
