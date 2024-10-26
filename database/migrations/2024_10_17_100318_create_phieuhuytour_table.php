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
        Schema::create('phieuhuytour', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('sotienhoan')->unsigned();
            $table->string('lydohuy');
            $table->integer('hoadon_id')->unsigned() ;
            $table->foreign('hoadon_id')->references('id')->on('hoadon')->onDelete('cascade');
            $table->timestamp('ngayhuy')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieuhuytour');
    }
};
