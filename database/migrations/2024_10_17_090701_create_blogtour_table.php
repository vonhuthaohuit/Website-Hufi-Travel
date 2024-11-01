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
            $table->increments('id');
            $table->text('tieude');
            $table->text('noidung');
            $table->boolean('trangthai');
            $table->integer('loaiblog_id')->unsigned();
            $table->foreign('loaiblog_id')->references('id')->on('loaiblog');
            $table->integer('nhanvien_id')->unsigned();
            $table->foreign('nhanvien_id')->references('id')->on('nhanvien');
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
