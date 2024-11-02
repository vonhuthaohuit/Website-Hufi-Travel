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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('mataikhoan');
            $table->string('tentaikhoan');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('matkhau');
            $table->string('trangthai');
            $table->rememberToken();
            $table->integer('manhomquyen')->unsigned() ;
            $table->string('google_id')->nullable();
            $table->foreign('manhomquyen')->references('manhomquyen')->on('nhomquyen')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
