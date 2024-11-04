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
        Schema::create('khachsan_tour', function (Blueprint $table) {
            $table->integer('khachsan_id')->unsigned();
            $table->integer('tour_id')->unsigned();
            $table->string('vitri') ;
            $table->integer('succhua')->unsigned();
            $table->primary(['tour_id', 'khachsan_id']);
            $table->foreign('tour_id')->references('id')->on('tour')->onDelete('cascade');
            $table->foreign('khachsan_id')->references('id')->on('khachsan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khachsan_tour');
    }
};
