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
        Schema::create('loaikhachhang', function (Blueprint $table) {
            $table->increments('maloaikhachhang');
            $table->string('tenloaikhachhang') ;
            $table->integer('mucapdunggia') ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loaikhachhang');
    }
};
