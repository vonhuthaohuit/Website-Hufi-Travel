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
        Schema::create('quyen_nhomquyen', function (Blueprint $table) {
            $table->integer('quyen_id')->unsigned();
            $table->integer('nhomquyen_id')->unsigned();
            $table->primary(['quyen_id', 'nhomquyen_id']);
            $table->foreign('quyen_id')->references('id')->on('quyen')->onDelete('cascade');
            $table->foreign('nhomquyen_id')->references('id')->on('nhomquyen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quyen_nhomquyen');
    }
};
