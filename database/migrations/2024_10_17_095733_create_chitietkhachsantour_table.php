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
        Schema::create('chitietkhachsantour', function (Blueprint $table) {
            $table->integer('makhachsan')->unsigned();
            $table->integer('matour')->unsigned();
            $table->string('vitriphong') ;
            $table->integer('succhua')->unsigned();
            $table->primary(['matour', 'makhachsan']);
            $table->foreign('matour')->references('matour')->on('tour')->onDelete('cascade');
            $table->foreign('makhachsan')->references('makhachsan')->on('khachsan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietkhachsantour');
    }
};
