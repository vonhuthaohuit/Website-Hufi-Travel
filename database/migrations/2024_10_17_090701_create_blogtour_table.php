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
        Schema::create('blogtour', function (Blueprint $table) {
            $table->increments('mablogtour');
            $table->text('tieude');
            $table->longtext('noidung');
            $table->boolean('trangthaiblog');
            $table->integer('maloaiblog')->unsigned();
            $table->foreign('maloaiblog')->references('maloaiblog')->on('loaiblog');
            $table->integer('manhanvien')->unsigned();
            $table->foreign('manhanvien')->references('manhanvien')->on('nhanvien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogtour');
    }
};
