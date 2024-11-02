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
        Schema::create('phancongchucvu', function (Blueprint $table) {
            $table->integer('manhanvien')->unsigned();
            $table->integer('machucvu')->unsigned();
            $table->primary(['manhanvien', 'machucvu']);
            $table->foreign('manhanvien')->references('manhanvien')->on('nhanvien')->onDelete('cascade');
            $table->foreign('machucvu')->references('machucvu')->on('chucvu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phancongchucvu');
    }
};
