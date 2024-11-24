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
        Schema::create('chitietphieudattour', function (Blueprint $table) {
            $table->integer('makhachhang')->unsigned() ;
            $table->integer('maphieudattour')->unsigned() ;
            $table->string('nguoidat')->nullable() ;
            $table->primary(['makhachhang', 'maphieudattour']);
            $table->float('chitietsotiendat') ;
            $table->foreign('makhachhang')->references('makhachhang')->on('khachhang')->onDelete('cascade');
            $table->foreign('maphieudattour')->references('maphieudattour')->on('phieudattour')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietphieudattour');
    }
};
