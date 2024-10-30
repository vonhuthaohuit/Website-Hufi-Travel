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
        Schema::create('chitiettour', function (Blueprint $table) {

            $table->date('ngaybatdau');
            $table->date('ngaykethuc');
            $table->bigInteger('gia') ;
            $table->integer('tour_id')->unsigned();
            $table->integer('diemdulich_id')->unsigned();
            $table->primary(['tour_id', 'diemdulich_id']);
            $table->foreign('diemdulich_id')->references('id')->on('diemdulich')->onDelete('cascade');
            $table->foreign('tour_id')->references('id')->on('tour')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitiettour');
    }
};
