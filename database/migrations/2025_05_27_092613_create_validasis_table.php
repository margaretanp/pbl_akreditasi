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
    Schema::create('validasi', function (Blueprint $table) {
        $table->unsignedBigInteger('id_validator')->primary();
        $table->unsignedBigInteger('id_user');
        $table->timestamp('validated_at')->nullable();
        $table->text('komentar')->nullable();
        $table->enum('status', ['pending', 'valid', 'invalid'])->default('pending');
        $table->timestamps();

        // Foreign key
        $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi');
    }
};
