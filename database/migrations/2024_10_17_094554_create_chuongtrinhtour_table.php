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
            $table->increments('id');
            $table->string('tieude');
<<<<<<< HEAD
            $table->string('ngay') ;
=======
            $table->string('ngay');
>>>>>>> main
            $table->date('thoigianbatdau') ;
            $table->date('thoigianketthuc') ;
            $table->string('mota');
            $table->integer('tour_id')->unsigned();
            $table->foreign('tour_id')->references('id')->on('tour')->onDelete('cascade');
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
