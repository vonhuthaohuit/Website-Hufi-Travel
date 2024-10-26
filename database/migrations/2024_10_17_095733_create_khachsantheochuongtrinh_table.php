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
        Schema::create('khachsantheochuongtrinh', function (Blueprint $table) {
            $table->integer('khachsan_id')->unsigned();
            $table->integer('chuongtrinhtour_id')->unsigned();
            $table->string('vitri') ;
            $table->integer('succhua')->unsigned();
            $table->primary(['chuongtrinhtour_id', 'khachsan_id']);
            $table->foreign('chuongtrinhtour_id')->references('id')->on('chuongtrinhtour')->onDelete('cascade');
            $table->foreign('khachsan_id')->references('id')->on('khachsan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khachsantheochuongtrinh');
    }
};
