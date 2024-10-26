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
            $table->integer('idnhanvien')->unsigned();
            $table->integer('idchucvu')->unsigned();
            $table->primary(['idnhanvien', 'idchucvu']);
            $table->foreign('idnhanvien')->references('id')->on('nhanvien')->onDelete('cascade');
            $table->foreign('idchucvu')->references('id')->on('chucvu')->onDelete('cascade');
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
