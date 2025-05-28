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
        $table->id();
        $table->unsignedBigInteger('id_user');
        $table->unsignedBigInteger('id_detail_kriteria');
        $table->timestamp('validated_at')->nullable();
        $table->text('komentar')->nullable();
        $table->enum('status', ['pending', 'valid', 'invalid'])->default('pending');
        $table->softDeletes();
        $table->timestamps();

        // Foreign key
        $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('id_detail_kriteria')->references('id')->on('detail_kriteria')->onDelete('cascade');
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
