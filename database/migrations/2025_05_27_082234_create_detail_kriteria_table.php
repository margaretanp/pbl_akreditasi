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
        Schema::create('detail_kriteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id')->constrained('kriteria');
            $table->foreignId('jenis_kriteria_id')->constrained('jenis_kriteria');
            $table->enum('status_validasi', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->enum('status_pengerjaan', ['save', 'submitted', 'revised'])->default('save');
            $table->text('file_url')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kriteria');
    }
};
