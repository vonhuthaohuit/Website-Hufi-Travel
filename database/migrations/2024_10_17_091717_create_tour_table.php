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
        Schema::create('tour', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tentour');
            $table->text('slug');
            $table->string('motatour');
            $table->boolean('tinhtrang');
            $table->string('hinhdaidien');
            $table->string('thoigiandi');
            $table->string('noikhoihanh');
            $table->integer('loaitour_id')->unsigned();
            $table->foreign('loaitour_id')->references('id')->on('loaitour')->onDelete('cascade');
            $table->integer('khuyenmai_id')->unsigned();
            $table->foreign('khuyenmai_id')->references('id')->on('khuyenmai')->onDelete('cascade');
            $table->timestamps();
            //'ngaytao'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour');
    }
};