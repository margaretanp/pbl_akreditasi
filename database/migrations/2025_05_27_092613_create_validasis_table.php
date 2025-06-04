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
    Schema::create('validators', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('kriteria_id');
        $table->text('komentar')->nullable();
        $table->boolean('is_validated')->default(false);
        $table->timestamp('validated_at')->nullable();
        $table->timestamps();
        $table->softDeletes();

        // Foreign key
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');
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
