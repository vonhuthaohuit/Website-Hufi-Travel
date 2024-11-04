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
            $table->integer('maquyen')->unsigned();
            $table->integer('manhomquyen')->unsigned();
            $table->primary(['maquyen', 'manhomquyen']);
            $table->foreign('maquyen')->references('maquyen')->on('quyen')->onDelete('cascade');
            $table->foreign('manhomquyen')->references('manhomquyen')->on('nhomquyen')->onDelete('cascade');
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
