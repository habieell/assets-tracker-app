<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            // Tambahkan kolom JSON baru untuk multiple images jika belum ada
            if (!Schema::hasColumn('assets', 'asset_images')) {
                $table->json('asset_images')->nullable()->after('invoice_number');
            }

            // Hapus kolom lama asset_image jika ada
            if (Schema::hasColumn('assets', 'asset_image')) {
                $table->dropColumn('asset_image');
            }
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            // Tambahkan kembali kolom lama jika di-rollback
            if (!Schema::hasColumn('assets', 'asset_image')) {
                $table->string('asset_image')->nullable()->after('invoice_number');
            }

            // Hapus kolom JSON multiple images
            if (Schema::hasColumn('assets', 'asset_images')) {
                $table->dropColumn('asset_images');
            }
        });
    }
};