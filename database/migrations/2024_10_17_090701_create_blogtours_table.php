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
        Schema::create('blogtour', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tieude') ;
            $table->string('noidung');
            $table->string('trangthai');
            $table->integer('loaiblog_id')->unsigned();
            $table->foreign('loaiblog_id')->references('id')->on('loaiblog');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogtour');
    }
};
