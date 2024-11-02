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
        Schema::create('chuongtrinhtour', function (Blueprint $table) {
            $table->increments('machuongtrinhtour');
            $table->string('tieude');
            $table->string('ngay') ;
            $table->Text('mota');
            $table->integer('matour')->unsigned();
            $table->foreign('matour')->references('matour')->on('tour')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chuongtrinhtour');
    }
};
