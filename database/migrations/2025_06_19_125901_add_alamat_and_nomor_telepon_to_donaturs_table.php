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
        Schema::table('donaturs', function (Blueprint $table) {
            // Check if the column doesn't exist before adding
            if (!Schema::hasColumn('donaturs', 'nomor_telepon')) {
                $table->string('nomor_telepon')->nullable()->after('password');
            }
            if (!Schema::hasColumn('donaturs', 'alamat')) {
                $table->text('alamat')->nullable()->after('nomor_telepon');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donaturs', function (Blueprint $table) {
            // This allows you to undo the migration
            $table->dropColumn(['alamat', 'nomor_telepon']);
        });
    }
};
