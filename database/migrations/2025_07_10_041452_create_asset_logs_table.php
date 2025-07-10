<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade'); // relasi ke aset
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // siapa yang melakukan
            $table->string('activity'); // contoh: 'dipindah', 'dipakai', 'rusak', dll
            $table->string('location')->nullable(); // lokasi baru jika ada
            $table->text('notes')->nullable(); // catatan tambahan jika ada
            $table->timestamp('logged_at')->useCurrent(); // waktu aktivitas

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_logs');
    }
};