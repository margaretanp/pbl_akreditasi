<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('validators', function (Blueprint $table) {
            $table->boolean("is_reject")->default(false)->after("validated_at");
            $table->timestamp("rejected_at")->nullable()->after("is_reject");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("validators", function (Blueprint $table) {
            $table->dropColumn(['is_reject', "rejected_at"]);
        });
    }
};
