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
        Schema::create('phuongtien', function (Blueprint $table) {
            $table->increments('maphuongtien');
            $table->string('tenphuongtien');
            $table->string('sodienthoai') ;
            $table->float('giaphuongtien') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phuongtien');
    }
};
