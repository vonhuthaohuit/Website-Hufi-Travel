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
        Schema::create('phongban', function (Blueprint $table) {
            $table->increments('maphongban');
            $table->string('tenphongban')->unique();
            //$table->integer('truongphong')->unsigned();
          //  $table->foreign('truongphong')->references('manhanvien')->on('nhanvien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phongban');
    }
};
