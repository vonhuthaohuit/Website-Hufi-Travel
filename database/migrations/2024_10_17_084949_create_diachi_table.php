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
        Schema::create('diachi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('xa') ;
            $table->string('huyen') ;
            $table->string('tinh') ;
            $table->string('ghichu') ;
            $table->integer('khachhang_id')->unsigned() ;
            $table->foreign('khachhang_id')->references('id')->on('khachhang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diachi');
    }
};
