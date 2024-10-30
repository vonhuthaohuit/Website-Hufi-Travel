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
            $table->integer('nhanvien_id')->unsigned();
            $table->integer('tour_id')->unsigned();
            $table->string('nhiemvu') ;
            $table->primary(['tour_id', 'nhanvien_id']);
            $table->foreign('tour_id')->references('id')->on('tour')->onDelete('cascade');
            $table->foreign('nhanvien_id')->references('id')->on('nhanvien')->onDelete('cascade');
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
