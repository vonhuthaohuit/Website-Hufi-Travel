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
        Schema::create('phieudattour', function (Blueprint $table) {
            $table->increments('maphieudattour');
            $table->integer('matour')->unsigned() ;
            $table->date('ngaydattour') ;
            $table->float('tongtienphieudattour')->unsigned();
            $table->string('trangthaidattour');
            $table->string('nguoidaidien') ;
            $table->foreign('matour')->references('matour')->on('tour')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieudattour');
    }
};
