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
        Schema::create('phancongnhanvien', function (Blueprint $table) {
            $table->integer('manhanvien')->unsigned();
            $table->integer('matour')->unsigned();
            $table->string('nhiemvu') ;
            $table->primary(['manhanvien', 'matour']);
            $table->foreign('matour')->references('matour')->on('tour')->onDelete('cascade');
            $table->foreign('manhanvien')->references('manhanvien')->on('nhanvien')->onDelete('cascade');
            $table->timestamps() ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phancongnhanvien');
    }
};
