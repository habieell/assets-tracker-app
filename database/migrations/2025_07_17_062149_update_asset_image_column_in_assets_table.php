<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('assets', function (Blueprint $table) {
        if (!Schema::hasColumn('assets', 'asset_image')) {
            $table->json('asset_image')->nullable(); // Tambahkan kolom baru
        }
    });
}

public function down(): void
{
    Schema::table('assets', function (Blueprint $table) {
        if (Schema::hasColumn('assets', 'asset_image')) {
            $table->dropColumn('asset_image'); // Hapus kolom saat rollback
        }
    });
}
};