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
        Schema::table('donasis', function (Blueprint $table) {
        if (Schema::hasColumn('donasis', 'kategori_id')) {
            $table->dropForeign(['kategori_id']);
                $table->dropColumn('kategori_id');
                }

        if (!Schema::hasColumn('donasis', 'kampanye_id')) {
                $table->foreignId('kampanye_id')->constrained('kampanyes')->onDelete('cascade')->after('user_id');
            }
        });
    }
    public function down(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
            if (Schema::hasColumn('donasis', 'kampanye_id')) {
                $table->dropForeign(['kampanye_id']);
                $table->dropColumn('kampanye_id');
            }

            if (!Schema::hasColumn('donasis', 'kategori_id')) {
                $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade')->after('user_id');
            }
        });
    }
    
};
