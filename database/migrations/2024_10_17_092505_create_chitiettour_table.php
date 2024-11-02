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
            $table->bigInteger('giachitiettour') ;
            $table->integer('matour')->unsigned();
            $table->integer('madiemdulich')->unsigned();
            $table->primary(['matour', 'madiemdulich']);
            $table->foreign('madiemdulich')->references('madiemdulich')->on('diemdulich')->onDelete('cascade');
            $table->foreign('matour')->references('matour')->on('tour')->onDelete('cascade');
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
